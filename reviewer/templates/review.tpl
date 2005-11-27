<h2>Avaliação de Proposta</h2>

<form action="reviewSave" method="POST">
<input type="hidden" name="proposta" value="{$proposta.cod}"/>
<table width="100%" class='formulario'>
  <tr>
    <th colspan="2">Proposta</th>
  </tr>
  <tr>
    <th>Autores</th>
    <td>
      <ul>
          <li><a href="speaker/{$proposta.cod_pessoa}">{$proposta.nome}</a></li>
        {section loop=$copalestrantes name=cp}
          <li><a href="speaker/{$copalestrantes[cp].cod}">{$copalestrantes[cp].nome}</a></li>
        {/section}
      </ul>
    </td>
  </tr>
  <tr>
    <th>Título</th>
    <td><a href="proposal/{$proposta.cod}">{$proposta.titulo}</a></td>
  </tr>
  <tr>
    <th>Macro-tema</th>
    <td><a href="tracks">{$proposta.macrotema}</a></td>
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
