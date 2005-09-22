<h2>{#reviews#}</h2>

<h3>{#proposalInfo#}</h3>

<ul>
  <li>
    <strong>{#author#}</strong>: {$person.nome}
  </li>
  <li>
    <strong>{#title#}</strong>: {$proposal.titulo}
  </li>
  <li>
    <strong>{#track#}</strong>: {$track.titulo}
  </li>
</ul>

<h3>{#legend#}</h3>
<div class='proposalBox'>
  <strong>{#confidence#}</strong>:
  {#confidenceExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>G</th>
      <td>{#generalist#}.</td>
    </tr>
    <tr>
      <th>C</th>
      <td>{#confortable#}</td>
    </tr>
    <tr>
      <th>E</th>
      <td>{#expert#}.</td>
    </tr>
  </table>

  <strong>{#relevance#}</strong>:
  {#relevanceExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>1</th>
      <td>{#none#}.</td>
    </tr>
    <tr>
      <th>2</th>
      <td>{#small#}.</td>
    </tr>
    <tr>
      <th>3</th>
      <td>{#some#}.</td>
    </tr>
    <tr>
      <th>4</th>
      <td>{#much#}.</td>
    </tr>
    <tr>
      <th>5</th>
      <td>{#extreme#}.</td>
    </tr>
  </table>

  <strong>{#quality#}</strong>:
  {#qualityExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>1</th>
      <td>{#none#}.</td>
    </tr>
    <tr>
      <th>2</th>
      <td>{#small#}.</td>
    </tr>
    <tr>
      <th>3</th>
      <td>{#some#}.</td>
    </tr>
    <tr>
      <th>4</th>
      <td>{#much#}.</td>
    </tr>
    <tr>
      <th>5</th>
      <td>{#extreme#}.</td>
    </tr>
  </table>

  <strong>{#experience#}</strong>:
  {#experienceExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>1</th>
      <td>{#none#}.</td>
    </tr>
    <tr>
      <th>2</th>
      <td>{#small#}.</td>
    </tr>
    <tr>
      <th>3</th>
      <td>{#some#}.</td>
    </tr>
    <tr>
      <th>4</th>
      <td>{#much#}.</td>
    </tr>
    <tr>
      <th>5</th>
      <td>{#extreme#}.</td>
    </tr>
  </table>
  
  <strong>{#recommendation#}</strong>:
  {#recommendationExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>R</th>
      <td>{#strong_rejection#}.</td>
    </tr>
    <tr>
      <th>r</th>
      <td>{#weak_rejection#}.</td>
    </tr>
    <tr>
      <th>a</th>
      <td>{#weak_acceptance#}.</td>
    </tr>
    <tr>
      <th>A</th>
      <td>{#strong_acceptance#}.</td>
    </tr>
  </table>

</div>

<h3>{#reviews#}</h3>
<div class='proposalBox'>

<table class='reviewSheet'>
  <tr>
    <th>{#reviewer#}</th>
    <th>{#confidence#}</th>
    <th>{#relevance#}</th>
    <th>{#quality#}</th>
    <th>{#experience#}</th>
    <th>{#recommendation#}</th>
    <th>{#commentsToAuthor#}</th>
  </tr>
{section loop=$reviews name=r}
  <tr>
    <td>{#reviewer#} #{$smarty.section.r.iteration}</td>
    <td>{if $reviews[r].confianca == 1}G
        {elseif $reviews[r].confianca == 1.5}C
        {else}E
        {/if}
    </td>
    <td>{$reviews[r].relevancia}</td>
    <td>{$reviews[r].qualidade}</td>
    <td>{$reviews[r].experiencia}</td>
    <td>{if $reviews[r].recomendacao == 1}R
        {elseif $reviews[r].recomendacao == 1.5}r
        {elseif $reviews[r].recomendacao == 1.75}a
        {else}A
        {/if}
    </td>
    <td>
    {if $reviews[r].comentarios_autor}
        {$reviews[r].comentarios_autor}
    {else}
      {#noComments#}
    {/if}
    </td>
  </tr>
{/section}
</table>
</div>
