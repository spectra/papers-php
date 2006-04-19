<a name="toc"></a>
<ul>
{section loop=$dias name=d}
  <li><a href="{php}echo $_SERVER['REQUEST_URI']{/php}#dia{$dias[d].numero}">{$dias[d].descricao}</a></li>
{/section}
</ul>

{section loop=$dias name=d}

<a name='dia{$dias[d].numero}'/>
<h2 style='background: #aaa;'>{$dias[d].descricao}</h2>

  {section loop=$salas name=s}

  <h3 style='background: #ddd;'>{$salas[s].descricao}</h3>
  
    {section loop=$horarios name=h}

       <h4 style='border-bottom: 1px solid black;'>{$horarios[h].inicio}</h4>
    
       {assign var="dia" value=$dias[d].numero}
       {assign var="sala" value=$salas[s].numero}
       {assign var="horario" value=$horarios[h].numero}
       {assign var="celula" value=$grade[$dia][$sala][$horario]}

       <center>
       <em>{$celula.macrotema}</em> <br/>
       <strong>{$celula.titulo|replace:"\\":""}</strong> <br/>
       <br/> <br/>
       {$celula.nome|replace:"\\":""} <br/>
       {section loop=$celula.copalestrantes name=cp}
         {$celula.copalestrantes[cp].nome|replace:"\\":""}<br/>
       {/section}

       {if count($celula.mesa)}
         <br/>
         <br/>
         Coordenação de mesa: <br/>
         {section loop=$celula.mesa name=m}
           {$celula.mesa[m].nome|replace:"\\":""} <br/>
         {/section}
       {/if}

       </center>
       
    {/section}
  {/section}
{/section}
