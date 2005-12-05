{literal}
<script language="javascript">
function toggle(id) {
  var element = document.getElementById(id);
  if (element.style.display == 'none') {
    element.style.display = 'block';
  } else {
    element.style.display = 'none';
  }
}
</script>
{/literal}


<h2>Avaliação de Proposta: {$proposta.titulo}</h2>

<form action="reviewSave" method="POST">
<input type="hidden" name="proposta" value="{$proposta.cod}"/>
<table width="100%" class='formulario'>
  <tr>
    <th colspan='2'>Detalhes da proposta
    </th>
  </tr>
  <tr>
    <td colspan="2">
      <div>
        <center>
        (<a href="javascript: toggle('proposal')">mostrar/esconder detalhes da proposta</a>)
        </center>
      </div>
      <div id='proposal' style='display: none;'>
        {include file=proposal.tpl}
      </div>
    </td>
  </tr>
  <tr>
    <th colspan='2'>Macro-tema: <a href="tracks">{$proposta.macrotema}</a></th>
  </tr>
  <tr>
    <th colspan='2'>Autores</th>
  </tr>
  <tr>
    <td colspan='2'>
      <ul>
        {section loop=$palestrantes name=cp}
          <li>
            <div>
              <a href="speaker/{$palestrantes[cp].cod}">{$palestrantes[cp].nome}</a>
              (<a href="javascript: toggle('speaker_{$palestrantes[cp].cod}')">mostrar/esconder detalhes</a>)
            </div>
            <div id='speaker_{$palestrantes[cp].cod}' style='display: none;'>
              <strong>Apelido(nickname):</strong>
              {$palestrantes[cp].nickname}
              <br/>
              <strong>e-mail:</strong>
              {$palestrantes[cp].email}
              <br/>
              <strong>Cidade/Estado/País:</strong>
              {$palestrantes[cp].cidade}/{$palestrantes[cp].estado}/{$palestrantes[cp].pais}
              <br/>
              <strong>Organização:</strong>
              {$palestrantes[cp].org}
              <hr/>
              <h3>Minicurrículo</h3>
              {$palestrantes[cp].biografia|regex_replace:"/\r\n\r\n|\n\n/":"<p/>"}
              <h3>Comentários</h3>
              {$palestrantes[cp].coment|regex_replace:"/\r\n\r\n|\n\n/":"<p/>"}
            </div>
          </li>
        {/section}
      </ul>
    </td>
  </tr>
  <tr>
    <th colspan='2'>
      Comentátios de outros avaliadores: (<a href="javascript: toggle('comments')">mostrar/esconder comentários</a>)
    </th>
  </tr>
  <tr>
    <td colspan='2'>
      <div id='comments' style='display: none;'>
      {section loop=$comentarios name=com}
        <strong>Avaliador #{$smarty.section.com.rownum}:</strong>
        <br/>
        {$comentarios[com].comentarios_comite|regex_replace:"/\r\n\r\n|\n\n/":"<p/>"}
        <hr/>
      {/section}
      </div>
    </td>
  </tr>
  <tr>
    <th colspan="2">Avaliação</th>
  </tr>
  <tr>
    <th>Grau de confiança</th>
    <td>
      Indique o grau de confiança da sua avaliação com relação a essa proposta: <br/><br/>
      <input type="radio" name="confianca" value="1" {if $avaliacao.confianca == 1 || !$avaliacao.confianca}checked="on"{/if}/> 
      não conheço bem o assunto, sou generalista. <br/>
      <input type="radio" name="confianca" value="1.5" {if $avaliacao.confianca == 1.5}checked="on"{/if}/> 
      não sou expert, mas sinto-me confortável com o assunto. <br/>
      <input type="radio" name="confianca" value="2" {if $avaliacao.confianca == 2}checked="on"{/if}/> 
      sou expert, conheço bastante o assunto. <br/>
    </td>
  </tr>
  <tr>
    <th>Relevância</th>
    <td>
      Indique a relevância da proposta para o evento: <br/><br/>
      <input type="radio" name="relevancia" value="1" {if $avaliacao.relevancia == 1 || !$avaliacao.relevancia}checked="on"{/if}/> Nenhuma
      <input type="radio" name="relevancia" value="2" {if $avaliacao.relevancia == 2}checked="on"{/if}/> Pouca
      <input type="radio" name="relevancia" value="3" {if $avaliacao.relevancia == 3}checked="on"{/if}/> Alguma
      <input type="radio" name="relevancia" value="4" {if $avaliacao.relevancia == 4}checked="on"{/if}/> Muita
      <input type="radio" name="relevancia" value="5" {if $avaliacao.relevancia == 5}checked="on"{/if}/> Extrema
    </td>
  </tr>
  <tr>
    <th>Qualidade técnica</th>
    <td>
      Indique a qualidade técnica da proposta (a partir do resumo): <br/><br/>
      <input type="radio" name="qualidade" value="1" {if $avaliacao.qualidade == 1 || !$avaliacao.qualidade}checked="on"{/if}/> Nenhuma
      <input type="radio" name="qualidade" value="2" {if $avaliacao.qualidade == 2}checked="on"{/if}/> Pouca
      <input type="radio" name="qualidade" value="3" {if $avaliacao.qualidade == 3}checked="on"{/if}/> Alguma
      <input type="radio" name="qualidade" value="4" {if $avaliacao.qualidade == 4}checked="on"{/if}/> Muita
      <input type="radio" name="qualidade" value="5" {if $avaliacao.qualidade == 5}checked="on"{/if}/> Extrema
    </td>
  </tr>
  <tr>
    <th>Experiência do autor</th>
    <td>
      Indique a experiência demonstrada pelo autor no assunto  proposta (a partir do currículo do autor): <br/><br/>
      <input type="radio" name="experiencia" value="1" {if $avaliacao.experiencia == 1 || !$avaliacao.experiencia}checked="on"{/if}/> Nenhuma
      <input type="radio" name="experiencia" value="2" {if $avaliacao.experiencia == 2}checked="on"{/if}/> Pouca
      <input type="radio" name="experiencia" value="3" {if $avaliacao.experiencia == 3}checked="on"{/if}/> Alguma
      <input type="radio" name="experiencia" value="4" {if $avaliacao.experiencia == 4}checked="on"{/if}/> Muita
      <input type="radio" name="experiencia" value="5" {if $avaliacao.experiencia == 5}checked="on"{/if}/> Extrema
    </td>
  </tr>
  <tr>
    <th>Recomendação Geral</th>
    <td>
      Indique a sua avaliação geral sobre a proposta:: <br/><br/>
      <input type="radio" name="recomendacao" value="1" {if $avaliacao.recomendacao == 1 || !$avaliacao.recomendacao}checked="on"{/if}/>
      Rejeição forte - Tenho argumentos fortes para rejeitar o trabalho.
      <br/>
      <input type="radio" name="recomendacao" value="1.5" {if $avaliacao.recomendacao == 1.5}checked="on"{/if}/>
      Rejeição fraca - Não tenho argumentos fortes para rejeitar o trabalho;
      tenho mais argumentos para rejeitar o trabalho do que para aceitar.
      <br/>
      <input type="radio" name="recomendacao" value="1.75" {if $avaliacao.recomendacao == 1.75}checked="on"{/if}/>
      Aceitação fraca - Não tenho argumentos fortes para aceitar o trabalho;
      tenho mais argumentos para aceitar o trabalho do que para rejeitar.
      <br/>
      <input type="radio" name="recomendacao" value="2" {if $avaliacao.recomendacao == 2}checked="on"{/if}/>
      Aceitação forte - Tenho argumentos fortes para aceitar o  trabalho.
    </td>
  </tr>
  <tr>
    <th>Comentários ao autor</th>
    <td>
      <textarea cols="60" rows="3" name="comentarios_autor">{$avaliacao.comentarios_autor}</textarea>
      </td>
  </tr>
  <tr>
    <th>Comentários à organização</th>
    <td>
      <textarea cols="60" rows="3" name="comentarios_comite">{$avaliacao.comentarios_comite}</textarea>
    </td>
  </tr>
  <tr>
    <th colspan="2"><input type="submit" value="Salvar"/></th>
  </tr>
</table>
</form>
