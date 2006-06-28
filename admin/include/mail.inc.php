<?php

// these functions were found at http://php.net/manual/en/function.mail.php,
// posted as a comment by lg83@free.fr . I assume they are in the public
// domain. So, as far as papers' authors are concerned, this file isn't
// licensed under the GNU GPL, but is in the public domain.

function encodeMimeSubject($s) {
   
   $lastspace=-1;
   $r="";
   $buff="";
   
   $mode=1;
   
   for ($i=0; $i<strlen($s); $i++) {
       $c=substr($s,$i,1);
       if ($mode==1) {
           $n=ord($c);
           if ($n & 128) {
               $r.="=?ISO-8859-1?Q?";
               $i=$lastspace;
               $mode=2;
           } else {
               $buff.=$c;
               if ($c==" ") {
                   $r.=$buff;
                   $buff="";
                   $lastspace=$i;
               }
           }
       } else if ($mode==2) {
           $r.=qpchar($c);
       }
   }
   if ($mode==2) $r.="?=";
   
   return $r;
   
}

function qpchar($c) {
   $n=ord($c);
   if ($c==" ") return "_";
   if ($n>=48 && $n<=57) return $c;
   if ($n>=65 && $n<=90) return $c;
   if ($n>=97 && $n<=122) return $c;
   return "=".($n<16 ? "0" : "").strtoupper(dechex($n));
   
}

?>
