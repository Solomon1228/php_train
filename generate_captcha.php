<?php
    define('USE_SESSION', true);
	session_start();

	$width  		    = 200;             //ширина картинки
	$height 		    = 120;              //высота картинки
	$count  		    = 4;    	       //кол-во символов капчи
	$fon_let_amount	    = 40;	           //количество символов на фоне
	$f_size   		    = 16;   	       //размер шрифта
	$font   		    = __DIR__ . "/fonts/ItcCushingLtHeavy.ttf";     //путь к файлу шрифта

	$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'; //Символы для капчи
	$colors  = array("90", "110", "130", "150", "170", "190", "210");   //Набор цветов для символов

	$img = imagecreatetruecolor($width, $height);

	$fon = imagecolorallocate($img, 250, 250, 250); //Функция созданияцвета фона
	imagefill($img, 0, 0, $fon);                    //Функция заливки выбранного изображения

	//добавляем на фон символам
	for($i=0; $i < $fon_let_amount; $i++){
		//случайный цвет
	   	$color = imagecolorallocatealpha($img,rand(0,255),rand(0,255),rand(0,255),100);	
	   	//случайный символ
	   	$letter = str_shuffle($letters)[rand(0,sizeof($letters)-1)];	
		//случайный размер								
	   	$size = rand($f_size-2,$f_size+2);											
	   	imagettftext($img,$size,rand(0,45), rand($width*0.1,$width-$width*0.1), rand($height*0.2,$height),$color,$font,$letter);
   }

	//Создание контента Капчи (Основные сиволы)
	for($i = 0; $i < $count; $i++){
		$color = imagecolorallocatealpha($img, $colors[rand(0, sizeof($colors) - 1)], $colors[rand(0, sizeof($colors) - 1)], $colors[rand(0, sizeof($colors) - 1)], rand(20, 40));
		$letter = str_shuffle($letters)[rand(0, sizeof($letters) - 1)]; //Случайный цвет символа
		$size = rand($f_size*2-2, $f_size*2+2);            //Случайный размер символа
		$x = ($i + 1) * ($f_size + 15) + rand(1, 5);              //Случайный х
		$y = $height/2 + $size/2;                          //Случайный у
		$capcha[] = $letter;                               //Добавляем в массив символ
		imagettftext($img, $size, rand(-10, 15), $x, $y , $color, $font, $letter);  //Выводим символ
	}

	$capcha = implode("",$capcha);

	header("Content-type: image/gif");          //Создание заголовка изображения
	$_SESSION["capcha"] = $capcha;  //Создание переменной сессии
	imagegif($img);                             //Выводим на экран
  
 
?>