<?php

/*

	// This way you would configure the class names and other stuff
	// It's OPTIONAL!

	$dr = new DwarfRunes();

	// this is how you could configure the generator to make the code shortest
	$dr->wrapper_class = 'dr';
	$dr->theme_class_light = 'l';
	$dr->theme_class_dark = 'd';
	$dr->letter_class_prefix = '';
	$dr->size_class_prefix = 's';
	$dr->image_path = 'dwarf-runes/dwarf-runes-{size}.png';

	$dr->wrapper_tag = 'span';
	$dr->letter_tag = 'span';
	
	// now you can use the public methods to generate CSS and encode text.
	
*/



/**
 *
 * HTML/CSS Dwarf Runes Generator
 * 
 * After you make an instance, you can assign your own configuration
 * to the public variables. It's recommended to cache the generated CSS,
 * ideally in an external stylesheet.
 * 
 * @copyright (C) MightyPork 2013
 * @website www.ondrovo.com
 * 
 */
class DwarfRunes {

	// --- configuration ---
	
	// image config
	public $image_path = 'images/dwarf-runes-{size}.png';
	
	public $addSelectableText = true;
	public $addToolTips = true;
	
	// CSS class names
	public $wrapper_class = 'dwarf-runes';
	public $theme_class_light = 'light';
	public $theme_class_dark = 'dark';
	public $letter_class_prefix = 'r-';
	public $size_class_prefix = 'size-';
	
	// HTML tags
	public $wrapper_tag = 'span';
	public $letter_tag = 'span';
	
	
	// --- end of configuration ---
	
	
	// ### Public API ###
	
		
	/**
	 *
	 * Make given $text into dwarf runes.
	 *
	 * @param $text input text
	 * @param $size letter size (you must have CSS for that size, and the matching sprite sheet)
	 * @param $theme color theme, "dark" or "light
	 * @param $use_doubles whether to use special marks for "th", "st", "ng" etc. (the original runes from Hobbit)
	 * 
	 * @returns output HTML
	 *
	 */
	public function encode($text, $size = 16, $theme = 'dark', $use_doubles = true){
	
		$text = trim($text);
		
		$text = str_replace('#', '#0', $text);
		
		$text = preg_replace('/th/i', '#1', $text);
		$text = preg_replace('/ea/i', '#2', $text);
		$text = preg_replace('/st([^a-z0-9]|$)/i', '#3$1', $text);
		$text = preg_replace('/ng([^a-z0-9]|$)/i', '#4$1', $text);
		$text = preg_replace('/ee/i', '#5', $text);
		
		$chars = str_split($text);
		
		$lastProcessedChar = '';
		$last=''; // for doubles
		$buffer='';
		
		$doubles = array(
			'#1', '#2', '#3', '#4', '#5', '#0'
		);
		
		foreach($chars as $char) {
		
			if($lastProcessedChar == "\n" && $char == ' ') continue;
			
			if($last != '') {
			
				$double = $last.$char;
				
				if($use_doubles && in_array(strtolower($double), $doubles)) {
				
					$last = '';
					$buffer .= $this->encode_char($double);
				
				} else {
				
					$buffer .= $this->encode_char($last);
					$last = $char;
				}
				
			} else {
				$last = $char;
			}
			
			$lastProcessedChar = $char;
		}
		
		if($last != '') $buffer .= $this->encode_char($last);
		
		$themeClass = ($theme == 'light') ? $this->theme_class_light : $this->theme_class_dark;
		
		return "<{$this->wrapper_tag} class='{$this->wrapper_class} {$themeClass} {$this->size_class_prefix}{$size}'>$buffer</{$this->wrapper_tag}>";
	}
	
	
	/**
	 *
	 * Generate CSS for the runes
	 *
	 * @param $wrap_in_stype_tag whether to enclose output in 'style' tag.
	 * @param $minify whether to minify output CSS (removes unneccessary whitespace and semicolons)
	 * @param $sizes array of letter sizes you want to use (px). Available: 8,10,12,16,24,32,36,48,64,72,96,128.
	 * @param $theme color theme: "light", "dark" or "both". Use "dark" for white backgrounds etc.
	 * 
	 * @returns the generated CSS
	 *
	 */
	public function generateCss($wrap_in_stype_tag = false, $minify = false, $sizes = array(16,24,32,36), $theme = 'dark') {
	
		$buffer = '';
		if($wrap_in_stype_tag) $buffer .= "<style type='text/css'>\n";
		
		// wrapper
		$buffer .= 	"{$this->wrapper_tag}.{$this->wrapper_class} {\n"
					."\tdisplay:inline; "
					."color:transparent;\n"
					."}\n";
		
		foreach($sizes as $size) {
			
			// wrapper selector
			$prefixBase = "{$this->wrapper_tag}.{$this->wrapper_class}.{$this->size_class_prefix}{$size}";
			
			// default letter style
			$img = str_replace('{size}', $size, $this->image_path);
			
			$buffer .= 	"{$prefixBase} {$this->letter_tag} {\n"
						."\tdisplay: inline-block; "
						."width: {$size}px; "
						."height: {$size}px; "
						."line-height: {$size}px; "
						."text-align: center; "
						."vertical-align: middle; "
						."background: url('{$img}') 0px {$size}px no-repeat; "
						."margin: 0; padding: 0;\n"
						."}\n";
			
			
			$prefixLight = "$prefixBase.{$this->theme_class_light}";
			$prefixDark = "$prefixBase.{$this->theme_class_dark}";
			
			if($theme == 'light' || $theme == 'both') {
				$y = 0;
				foreach($this->rune_classes as $c) {
					$buffer .= "{$prefixLight} .{$this->letter_class_prefix}{$c} { background-position: 0px -{$y}px; }\n";
					$y += $size;
				}
			}

			if($theme == 'dark' || $theme == 'both') {
				$y = 0;
				foreach($this->rune_classes as $c) {
					$buffer .= "{$prefixDark} .{$this->letter_class_prefix}{$c} { background-position: -{$size}px -{$y}px; }\n";
					$y += $size;
				}
			}
		}
			
		if($wrap_in_stype_tag) $buffer .= "</style>";
		
		if($minify) {
			$buffer = preg_replace('#\n*#','',$buffer);
			$buffer = preg_replace('#\s*([{}])\s*#','$1',$buffer);
			$buffer = preg_replace('#([;:])\s*#','$1',$buffer);
			$buffer = preg_replace('#;[}]#','}',$buffer);
		}
		
		return $buffer;
	}
	
	
	
	// ### PRIVATE STUFF ###
	
	
	// transliteration of non-alphanum chars
	private $translate = array(
		' '=>'space', '-'=>'dash', '_'=>'underscore', '@'=>'atsign', 
		','=>'comma', '.'=>'dot', '!'=>'bang', '?'=>'question', 
		';'=>'semicolon', '['=>'bracketl', ']'=>'bracketr', '('=>'parenl', 
		')'=>'parenr', '{'=>'bracel', '}'=>'bracer', '<'=>'less', 
		'>'=>'greater', '$'=>'dollar', '/'=>'slash', '\\'=>'backslash', 
		'+'=>'plus', ':'=>'colon', '#'=>'hash', '='=>'equals', 
		'%'=>'percent', '"'=>'quote', '\''=>'apos', '|'=>'pipe', 
		'*'=>'asterisk', '^'=>'power', '~'=>'tilde', '&'=>'and', 
	);
	
	
	private $unescapeDoubles = array(
		'#0'=>'#',
		'#1'=>'th',
		'#2'=>'ea',
		'#3'=>'st',
		'#4'=>'ng',
		'#5'=>'ee',
	);
	
	
	private $rune_classes = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
		'th',  'ea',  'st',  'ng',  'ee', 
		'n0', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8', 'n9', 
		'dash', 'underscore', 'atsign', 'comma', 'dot', 
		'bang', 'question', 'semicolon', 'bracketl', 'bracketr', 
		'parenl', 'parenr', 'bracel', 'bracer', 'less', 'greater', 
		'dollar', 'slash', 'backslash', 'plus', 'colon', 'hash', 
		'equals', 'percent', 'quote', 'apos', 'pipe', 'asterisk', 
		'power', 'tilde', 'and', 'space'
	);
	
	
	private function encode_char($char) {

		$char = strtr($char, $this->unescapeDoubles);
		
		$charL = strtolower($char);
		
		$char = htmlspecialchars($char);
		if($char == "\n") return "<br>\n";
		if($char == " ") $char = '&nbsp;';
		
		if(preg_match('/[0-9]/i', $charL)) $charL = 'n' . $charL;
		
		// try to translate
		if(array_key_exists($charL, $this->translate)) $charL = $this->translate[$charL];
		// fallback
		if(!preg_match('/[ a-z0-9_-]+/i', $charL)) return $char;
		// print span
		
		$out = "<{$this->letter_tag} ";
		$out .= "class='{$this->letter_class_prefix}{$charL}' ";
		if($this->addToolTips) $out .= "title='{$char}'";
		$out .= ">";
		if($this->addSelectableText) $out .= $char;
		$out .= "</{$this->letter_tag}>";
		
		return $out;
	}	
}