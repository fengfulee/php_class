<?PHP
#	用PHP 的DOM控件来创建XML输出...
#	设置输出内容的类型为xml..
	header('Content-type:text/xml;');
	$dom = new DOMDocument('1.0','utf-8');

	//建立response标签..
	$response = $dom -> createElement('response');
	$dom -> appendChild($response);
	
	$books = $dom -> createElement('books');
	$response -> appendChild($books);
	
	$title = $dom -> createElement('title');
	$titleText = $dom -> createTextNode('PHP与AJAX');
	$title -> appendChild($titleText);

	$isbn  = $dom -> createElement('isbn');
	$isbnText = $dom -> createTextNode('123456');
	$isbn -> appendChild($isbnText);
	
	$book = $dom -> createElement('book');
	$book -> appendChild($title);
	$book -> appendChild($isbn);

	$books -> appendChild($book);
	#$books -> appendChild($book);
	#要进行保存..
	$xmlString = $dom -> saveXML();

	echo $xmlString;
	
?>
