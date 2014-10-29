<?php namespace MightyPork\Wrack; ?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

<h1>Group listing</h1>

<table>
	<tr><td>Name:</td><td>{{{ $g->name }}}</td></tr>
	<tr><td>Description:</td><td>{{{ $g->description }}}</td></tr>
	<tr>
		<td>Sub-groups:</td>
		<td>
			<ul>
				@foreach ($g->groups as $g)
				<?php
					$gg = new Group($g);
				?>
					<li><a href="{{{ $g }}}">{{{ $gg->name }}}</a>
				@endforeach
			</li>
		</td>
	</tr>
	<tr>
		<td>Articles:</td>
		<td>
			<ul>
				@foreach ($g->articles as $a)
				<?php
					$aa = new Article($a);
				?>
					<li><a href="{{{ $a }}}">{{{ $aa->name }}}</a>
				@endforeach
			</li>
		</td>
	</tr>
</table>

</body>
</html>
