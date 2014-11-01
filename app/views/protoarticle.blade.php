<!DOCTYPE HTML>
<html>
<head>
<base href="/{{ $a->path }}/">
</head>
<body>

<h1>Article detail</h1>

<table>
	<tr><td>Name:</td><td>{{ $a->name }}</td></tr>
	<tr><td>Canonical name:</td><td>{{ $a->canonical }}</td></tr>
	<tr><td>Created:</td><td>{{ date('Y-m-d', $a->created) }}</td></tr>
	<tr><td>Tags:</td><td>{{ implode(', ', $a->tags) }}</td></tr>
	<tr><td>Description:</td><td>{{ $a->description }}</td></tr>
	<tr><td>Path:</td><td>{{ $a->path }}</td></tr>
	<tr><td>Body file:</td><td>{{ $a->body_file }}</td></tr>
	<tr><td>Body markup:</td><td>{{ $a->markup }}</td></tr>
	<tr>
		<td>Body:</td>
		<td>
			@if($a->markup == 'txt')
				<pre>{{{ $body }}}</pre>
			@elseif($a->markup == 'md')
				{{ $md->transform($body) }}
			@else
				{{{ $body }}}
			@endif
		</td>
	</tr>
</table>

</body>
</html>
