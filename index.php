<?php
echo "ciao";
$myvar="sono una variabile";
$myvar=5;
echo '<br>'.$myvar;
// debolmente tipizzato, non devo dichiarare il tipo delle variabili
// posso etterci informazioni diverse di tipo diverso

$a=0;
$b='0';
if($a===$b){//fa il type coercion, quindi il casting
    echo 'sono uguali';
}else{
    echo "<br>"."non sono uguali";
}
//operatore di identità guarda il valore e il tipo
//altri operatori
//isset(nomeVar)- empty(nomeVar)-isnull()
//isset se istanziata
//is empty se vuota
//is null se il valore è null
$vuoto=0;
$var4=5;
$nnullo=null;
if(isset($var4)){
    echo '<br>esiste';
}
if(empty($vuoto)){
    echo '<br>vuota';
}
if(is_null($nnullo)){
    echo '<br> è nulla';
}
echo is_null($vuoto);
echo is_null($var4);
if(3.5==='3.5'){
    echo '<br> uguali';
}
if(true==='false'){
    echo "<br> è vero";
}
if(0==" "){
    echo "<br> è vero";
}
//iteration structures:do while - while -for -break and continue
//selection structures if-if else - switch
//
//match
$grade='j';
$message=match($grade){
    'A'=>'letter a',
    'B'=>'letter b',
    'C','D'=> 'letter c or d',
    default =>'other letters'
};
echo '<br>'.$message;
$subtotal=200;
$total=0;
$total=match(true){
    $subtotal<=200 =>$total=$subtotal*0.9,
    $subtotal>200 =>$total=$subtotal*0.8,
};
echo '<br>'.$total;
//conditional operator
$num1=200;
$num2=100;
$num1>$num2?$r='ok':$r='ko';
echo '<br>'.$r;
$null0=0;
//coalescing operator
$num3=$null0??$num2;//se la prima è nulla lui prende la seconda altrimenti la prima
echo '<br>'.$num3;
//spaceship operator
echo $num1<=>$num2;//se il sx < -1 se = 0 se > 1
/*
 * strings
 * array
 * classes
 * datetime
 * importing files
 * ecc
 *
 * */
// strings
/*
 *
 * */

$language='PHP';
$message='<br> welcome to '.$language;
echo $message;
$message2=" <br> welcome to $language";//interpolazione i "" vanno ad intercettare e riconoscere le variabili
echo $message2;
$count=12;
$item='flower';
$message4="<br> you have $count ${item}s <br>";//puoi isolare la var con { }
echo $message4;
$message5=<<< MESSAGE
Cominato è molto bello,patatoso,chupaposo,dingoso e molto feinoso ragazzo
un po biricchino e diddyino.
Angelo è molto sigma.▲◄19ƒ6╠æå4H7╩42♣4◘♦8•4◘•♀TD6»♦4@654 46♦65♦64♠4♠4141♠♦64♠4☺442`
MESSAGE;
echo $message5.'<br>';
/*
 * funzioni da saper
 * strlen()
 * substring()
 * substr_replace()
 * trim()
 * ltrim() rtrim
 * stripslashes()
 * str_pad()
 * strpos()
 * strtpos()
 * stripos()
 * str_contains()
 * str_starts_with()
 * str_end_with()
 * strToUpper()
 * strToLower()
 * ucfirst()
 * ucwords()
 * strrev()
 * str_shuffle()
 * str_repeat()
 * str_replace()
 * strcmp()
 * strcasecmp()
 * strnstcmp()
 * explode()
 * implode()
 * chr() - ord()
 * */












