<?php


$path = ltrim($_SERVER['REQUEST_URI'], '/');  
$elements = explode('/', $path);              
if(empty($elements[0])) {                       // No path elements means home
    show_index();
} else switch(array_shift($elements))             // Pop off first item and switch
{
    case 'showlabels':
        header("Location: /demo_all_labels.html");
		exit();
        break;
    case 'qalabels':
        header("Location: /display_measurements.html");
		break;
    default:
        
		header('HTTP/1.1 404 Not Found');
        show_404();
}


function show_index()
{
	
$title="QA Label rapid prototyping";
$html=<<<EOL


<html>

<head><title>$title</title>

</head>

<body > 
<h1>$title</h1>

<ul>
<li><a href="/qalabels">Show measurements</a></li>
<li><a href="/showlabels">Render label visuals</a></li>
<li><a href="/">This page</a></li>


</ul>

</body>
</html>


EOL;

echo $html;
	
}



function show_404 ()
{
	
$title="Not found / 404";
$html=<<<EOL

<html>

<head><title>$title</title>

</head>

<body > 
<h1>$title</h1>
</body>
</html>

EOL;

echo $html;
	
}

