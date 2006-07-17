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

{if $event.file_upload_on_submission}
<ul>
{section loop=$files name=f}
<li> <a href='download/{$files[f]}'>{$proposta.titulo}: {$files[f]}</a></li>
{/section}
</ul>
{/if}

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
{if ! $event.blind_review}
  <tr>
    <th colspan='2'>Autores</th>
  </tr>
  <tr>
    <td colspan='2'>
      <ul>
        {section loop=$palestrantes name=cp}
          <li>
            <div>
              {$palestrantes[cp].nome}
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
{/if}
  <tr>
    <th colspan='2'>
      Comentários de outros avaliadores: (<a href="javascript: toggle('comments')">mostrar/esconder comentários</a>)
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
{if $event.review_type == "fisl" || ! $event.review_type}
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
{/if}
{if $event.review_type == "simple"}
  <tr>
    <th>Conceito</th>
    <td>
      <select name="recomendacao">
        <option {if $avaliacao.recomendacao == 0.0}selected{/if}>0.0</option>
        <option {if $avaliacao.recomendacao == 0.1}selected{/if}>0.1</option>
        <option {if $avaliacao.recomendacao == 0.2}selected{/if}>0.2</option>
        <option {if $avaliacao.recomendacao == 0.3}selected{/if}>0.3</option>
        <option {if $avaliacao.recomendacao == 0.4}selected{/if}>0.4</option>
        <option {if $avaliacao.recomendacao == 0.5}selected{/if}>0.5</option>
        <option {if $avaliacao.recomendacao == 0.6}selected{/if}>0.6</option>
        <option {if $avaliacao.recomendacao == 0.7}selected{/if}>0.7</option>
        <option {if $avaliacao.recomendacao == 0.8}selected{/if}>0.8</option>
        <option {if $avaliacao.recomendacao == 0.9}selected{/if}>0.9</option>
        <option {if $avaliacao.recomendacao == 1.0}selected{/if}>1.0</option>
        <option {if $avaliacao.recomendacao == 1.1}selected{/if}>1.1</option>
        <option {if $avaliacao.recomendacao == 1.2}selected{/if}>1.2</option>
        <option {if $avaliacao.recomendacao == 1.3}selected{/if}>1.3</option>
        <option {if $avaliacao.recomendacao == 1.4}selected{/if}>1.4</option>
        <option {if $avaliacao.recomendacao == 1.5}selected{/if}>1.5</option>
        <option {if $avaliacao.recomendacao == 1.6}selected{/if}>1.6</option>
        <option {if $avaliacao.recomendacao == 1.7}selected{/if}>1.7</option>
        <option {if $avaliacao.recomendacao == 1.8}selected{/if}>1.8</option>
        <option {if $avaliacao.recomendacao == 1.9}selected{/if}>1.9</option>
        <option {if $avaliacao.recomendacao == 2.0}selected{/if}>2.0</option>
        <option {if $avaliacao.recomendacao == 2.1}selected{/if}>2.1</option>
        <option {if $avaliacao.recomendacao == 2.2}selected{/if}>2.2</option>
        <option {if $avaliacao.recomendacao == 2.3}selected{/if}>2.3</option>
        <option {if $avaliacao.recomendacao == 2.4}selected{/if}>2.4</option>
        <option {if $avaliacao.recomendacao == 2.5}selected{/if}>2.5</option>
        <option {if $avaliacao.recomendacao == 2.6}selected{/if}>2.6</option>
        <option {if $avaliacao.recomendacao == 2.7}selected{/if}>2.7</option>
        <option {if $avaliacao.recomendacao == 2.8}selected{/if}>2.8</option>
        <option {if $avaliacao.recomendacao == 2.9}selected{/if}>2.9</option>
        <option {if $avaliacao.recomendacao == 3.0}selected{/if}>3.0</option>
        <option {if $avaliacao.recomendacao == 3.1}selected{/if}>3.1</option>
        <option {if $avaliacao.recomendacao == 3.2}selected{/if}>3.2</option>
        <option {if $avaliacao.recomendacao == 3.3}selected{/if}>3.3</option>
        <option {if $avaliacao.recomendacao == 3.4}selected{/if}>3.4</option>
        <option {if $avaliacao.recomendacao == 3.5}selected{/if}>3.5</option>
        <option {if $avaliacao.recomendacao == 3.6}selected{/if}>3.6</option>
        <option {if $avaliacao.recomendacao == 3.7}selected{/if}>3.7</option>
        <option {if $avaliacao.recomendacao == 3.8}selected{/if}>3.8</option>
        <option {if $avaliacao.recomendacao == 3.9}selected{/if}>3.9</option>
        <option {if $avaliacao.recomendacao == 4.0}selected{/if}>4.0</option>
        <option {if $avaliacao.recomendacao == 4.1}selected{/if}>4.1</option>
        <option {if $avaliacao.recomendacao == 4.2}selected{/if}>4.2</option>
        <option {if $avaliacao.recomendacao == 4.3}selected{/if}>4.3</option>
        <option {if $avaliacao.recomendacao == 4.4}selected{/if}>4.4</option>
        <option {if $avaliacao.recomendacao == 4.5}selected{/if}>4.5</option>
        <option {if $avaliacao.recomendacao == 4.6}selected{/if}>4.6</option>
        <option {if $avaliacao.recomendacao == 4.7}selected{/if}>4.7</option>
        <option {if $avaliacao.recomendacao == 4.8}selected{/if}>4.8</option>
        <option {if $avaliacao.recomendacao == 4.9}selected{/if}>4.9</option>
        <option {if $avaliacao.recomendacao == 5.0}selected{/if}>5.0</option>
        <option {if $avaliacao.recomendacao == 5.1}selected{/if}>5.1</option>
        <option {if $avaliacao.recomendacao == 5.2}selected{/if}>5.2</option>
        <option {if $avaliacao.recomendacao == 5.3}selected{/if}>5.3</option>
        <option {if $avaliacao.recomendacao == 5.4}selected{/if}>5.4</option>
        <option {if $avaliacao.recomendacao == 5.5}selected{/if}>5.5</option>
        <option {if $avaliacao.recomendacao == 5.6}selected{/if}>5.6</option>
        <option {if $avaliacao.recomendacao == 5.7}selected{/if}>5.7</option>
        <option {if $avaliacao.recomendacao == 5.8}selected{/if}>5.8</option>
        <option {if $avaliacao.recomendacao == 5.9}selected{/if}>5.9</option>
        <option {if $avaliacao.recomendacao == 6.0}selected{/if}>6.0</option>
        <option {if $avaliacao.recomendacao == 6.1}selected{/if}>6.1</option>
        <option {if $avaliacao.recomendacao == 6.2}selected{/if}>6.2</option>
        <option {if $avaliacao.recomendacao == 6.3}selected{/if}>6.3</option>
        <option {if $avaliacao.recomendacao == 6.4}selected{/if}>6.4</option>
        <option {if $avaliacao.recomendacao == 6.5}selected{/if}>6.5</option>
        <option {if $avaliacao.recomendacao == 6.6}selected{/if}>6.6</option>
        <option {if $avaliacao.recomendacao == 6.7}selected{/if}>6.7</option>
        <option {if $avaliacao.recomendacao == 6.8}selected{/if}>6.8</option>
        <option {if $avaliacao.recomendacao == 6.9}selected{/if}>6.9</option>
        <option {if $avaliacao.recomendacao == 7.0}selected{/if}>7.0</option>
        <option {if $avaliacao.recomendacao == 7.1}selected{/if}>7.1</option>
        <option {if $avaliacao.recomendacao == 7.2}selected{/if}>7.2</option>
        <option {if $avaliacao.recomendacao == 7.3}selected{/if}>7.3</option>
        <option {if $avaliacao.recomendacao == 7.4}selected{/if}>7.4</option>
        <option {if $avaliacao.recomendacao == 7.5}selected{/if}>7.5</option>
        <option {if $avaliacao.recomendacao == 7.6}selected{/if}>7.6</option>
        <option {if $avaliacao.recomendacao == 7.7}selected{/if}>7.7</option>
        <option {if $avaliacao.recomendacao == 7.8}selected{/if}>7.8</option>
        <option {if $avaliacao.recomendacao == 7.9}selected{/if}>7.9</option>
        <option {if $avaliacao.recomendacao == 8.0}selected{/if}>8.0</option>
        <option {if $avaliacao.recomendacao == 8.1}selected{/if}>8.1</option>
        <option {if $avaliacao.recomendacao == 8.2}selected{/if}>8.2</option>
        <option {if $avaliacao.recomendacao == 8.3}selected{/if}>8.3</option>
        <option {if $avaliacao.recomendacao == 8.4}selected{/if}>8.4</option>
        <option {if $avaliacao.recomendacao == 8.5}selected{/if}>8.5</option>
        <option {if $avaliacao.recomendacao == 8.6}selected{/if}>8.6</option>
        <option {if $avaliacao.recomendacao == 8.7}selected{/if}>8.7</option>
        <option {if $avaliacao.recomendacao == 8.8}selected{/if}>8.8</option>
        <option {if $avaliacao.recomendacao == 8.9}selected{/if}>8.9</option>
        <option {if $avaliacao.recomendacao == 9.0}selected{/if}>9.0</option>
        <option {if $avaliacao.recomendacao == 9.1}selected{/if}>9.1</option>
        <option {if $avaliacao.recomendacao == 9.2}selected{/if}>9.2</option>
        <option {if $avaliacao.recomendacao == 9.3}selected{/if}>9.3</option>
        <option {if $avaliacao.recomendacao == 9.4}selected{/if}>9.4</option>
        <option {if $avaliacao.recomendacao == 9.5}selected{/if}>9.5</option>
        <option {if $avaliacao.recomendacao == 9.6}selected{/if}>9.6</option>
        <option {if $avaliacao.recomendacao == 9.7}selected{/if}>9.7</option>
        <option {if $avaliacao.recomendacao == 9.8}selected{/if}>9.8</option>
        <option {if $avaliacao.recomendacao == 9.9}selected{/if}>9.9</option>
        <option {if $avaliacao.recomendacao == 10.0}selected{/if}>10.0</option>
      </select>
    </td>
  </tr>
{/if}
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
