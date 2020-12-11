var i = 0;

function	time_count()
{
	postMessage(i++);
	setTimeout("time_count()", 500);
}

time_count();
