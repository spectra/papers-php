<h1>Notificação em massa</h1>

<p>
Selecione o grupo de proposstas a serem notificadas.
</p>
<ul>
  <li>
    <strong>Aceitas:</strong>
    Os autores de propostas aceitas.
  </li>
  <li>
    <strong>Recusadas:</strong>
    Os autores de propostas recusadas. Para
    <em>avisá-los para esperar mais um pouco ;-)</em>
    ou 
    <em>para avisá-los que já era</em>
    .
  </li>
  <li>
    <strong>Aceitas e Não confirmadas:</strong>
    Para <em>Notificação de prorrogação de prazo para confirmação</em> ou para
    <em>informar que estão sendo consideradas com desistência</em>.
  </li>
</ul>

<p>
<strong>
Certifique-se de que o processo de avaliação tenha terminado, ou você terá
problemas sérios! :-)
</strong>
</p>

<center>
<form action="" method="POST">
  <table>
    <tr>
      <td>
        <input type='radio' name='tipo' value='aceitas' checked/> Aceitas <br/>
      </td>
    </tr>
    <tr>
      <td>
        <input type='radio' name='tipo' value='recusadas'/> Recusadas <br/>
      </td>
    </tr>
    <tr>
      <td>
        <input type='radio' name='tipo' value='nao_confirmadas'/> Aceitas e Não confirmadas <br/>
      </td>
    </tr>
    <tr>
      <tr>
        <td>
          <strong>Mensagem a ser enviada.</strong> As seguinte variáveis serão substituídas no texto:
          <ul>
             <li><code>$nome</code>: nome do proponente</li>
             <li><code>$titulo</code>: título da proposta</li>
             <li><code>$cod</code>: código da proposta</li>
          </ul>
          <textarea name="texto" rows='20' cols='80'></textarea>
        </td>
      </tr>
    </tr>
    <tr>
      <td align='center'>
        <input type="hidden" name="confirm" value="1"/>
        <input type="submit" value="Enviar!"/>
      </td>
    </tr>
  </table>
</form>
</center>

