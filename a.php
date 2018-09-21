<?
function closure($n,$counter,$max){
  //匿名函数，这里函数的参数加&符号是，引址调用参数自己
  $fn = function (&$n,&$counter,&$max=1) use(&$fn){//use参数传递的是函数闭包函数自身
    $n++;
    if($n <= $max){//递归点，也就是递归的条件
      $counter .=$n.'<br />';
      //递归调用自己
      $fn($n,$counter,$max);
    }
    return $counter;
  };
  //记得这里必须加``;``分号，不加分号php会报错，闭包函数
  /*
  *这里函数closure的返回值就是调用闭包的匿名函数
  *而闭包函数，引用closure函数传进来的参数
  */
	//return $fn($n,$counter,$max);
}
echo (closure(0,'',10));

