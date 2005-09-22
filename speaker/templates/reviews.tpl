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

<h3>{#reviews#}</h3>
{section loop=$reviews name=r}
<div class='proposalBox'>
<h4>{#reviewer#} #{$smarty.section.r.iteration}</h4>
  <strong>{#confidence#}</strong>:
  {#confidenceExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>{if $reviews[r].confianca == 1}X{else}&nbsp;{/if}</th>
      <td>{#generalist#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].confianca == 1.5}X{else}&nbsp;{/if}</th>
      <td>{#confortable#}</td>
    </tr>
    <tr>
      <th>{if $reviews[r].confianca == 2}X{else}&nbsp;{/if}</th>
      <td>{#expert#}.</td>
    </tr>
  </table>

  <strong>{#relevance#}</strong>:
  {#relevanceExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>{if $reviews[r].relevancia == 1}X{else}&nbsp;{/if}</th>
      <td>{#none#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].relevancia == 2}X{else}&nbsp;{/if}</th>
      <td>{#small#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].relevancia == 3}X{else}&nbsp;{/if}</th>
      <td>{#some#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].relevancia == 4}X{else}&nbsp;{/if}</th>
      <td>{#much#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].relevancia == 5}X{else}&nbsp;{/if}</th>
      <td>{#extreme#}.</td>
    </tr>
  </table>

  <strong>{#quality#}</strong>:
  {#qualityExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>{if $reviews[r].qualidade == 1}X{else}&nbsp;{/if}</th>
      <td>{#none#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].qualidade == 2}X{else}&nbsp;{/if}</th>
      <td>{#small#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].qualidade == 3}X{else}&nbsp;{/if}</th>
      <td>{#some#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].qualidade == 4}X{else}&nbsp;{/if}</th>
      <td>{#much#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].qualidade == 5}X{else}&nbsp;{/if}</th>
      <td>{#extreme#}.</td>
    </tr>
  </table>

  <strong>{#experience#}</strong>:
  {#experienceExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>{if $reviews[r].experiencia == 1}X{else}&nbsp;{/if}</th>
      <td>{#none#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].experiencia == 2}X{else}&nbsp;{/if}</th>
      <td>{#small#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].experiencia == 3}X{else}&nbsp;{/if}</th>
      <td>{#some#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].experiencia == 4}X{else}&nbsp;{/if}</th>
      <td>{#much#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].experiencia == 5}X{else}&nbsp;{/if}</th>
      <td>{#extreme#}.</td>
    </tr>
  </table>
  
  <strong>{#recommendation#}</strong>:
  {#recommendationExplanation#}.
  <table class='reviewSheet'>
    <tr>
      <th>{if $reviews[r].recomendacao == 1}X{else}&nbsp;{/if}</th>
      <td>{#strong_rejection#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].recomendacao == 1.5}X{else}&nbsp;{/if}</th>
      <td>{#weak_rejection#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].recomendacao == 1.75}X{else}&nbsp;{/if}</th>
      <td>{#weak_acceptance#}.</td>
    </tr>
    <tr>
      <th>{if $reviews[r].recomendacao == 2}X{else}&nbsp;{/if}</th>
      <td>{#strong_acceptance#}.</td>
    </tr>
  </table>

    <strong>{#commentsToAuthor#}:</strong>
    {if $reviews[r].comentarios_autor}
      <div class='reviewSheet'>
        {$reviews[r].comentarios_autor}
      </div>
    {else}
      {#noComments#}
    {/if}
  
</div>
{/section}

