{if !$PERIOD_SUBMISSION}
<p><em style='color:red;'>{#submissionIsOver#}</em></p>
{/if}
<h2>{#yourProposals#}</h2>
{if !count($proposals)}
<p><em>{#noProposalsFound#}</em></p>
{/if}
{section loop=$proposals name=pr}
<div class='proposalBox'>
  <h3>
    {$proposals[pr].titulo}
    {if $PERIOD_SUBMISSION }
      <!-- ***************************************** -->
      <!-- start of SUBMISSION -->
      <!-- ***************************************** -->
      <a style='font-size: smaller' href="submit/{$proposals[pr].cod}">({#edit#})</a>
      <a style='font-size: smaller' href="submitRemove/{$proposals[pr].cod}" onclick="return confirm('{#removeConfirm#}');">({#remove#})</a>
      <!-- ***************************************** -->
      <!-- start of SUBMISSION -->
      <!-- ***************************************** -->
    {/if}
  </h3>
  <!-- ***************************************** -->
  <!-- start of RESULTS -->
  <!-- ***************************************** -->
  {if ($PERIOD_RESULT && $proposals[pr].tipo == 's') || ( ($proposals[pr].tipo == 'p' || $proposals[pr].tipo == 'v' || $proposals[pr].tipo == 'c') && $PERIOD_UPDATES)}
    <div>
      {if $proposals[pr].tipo == 's'}
        <strong>Status:</strong>
        <span class='status_{$proposals[pr].status}'>
        {if $proposals[pr].status == 'a' || $proposals[pr].status == 'p'}
        {#accepted#}
        {/if}
        {if $proposals[pr].status == 'r'}
        {#rejected#}
        {/if}
        {if $proposals[pr].status == 'i'}
        {#undefined#}
        {/if}
        {if $proposals[pr].status == 'd'}
        {#gaveUp#}
        {/if}
        </span>
      {/if}
    </div>
    <div>
      {if $proposals[pr].status == 'a' || $proposals[pr].status == 'p'}
        {if $proposals[pr].confirmada}
          <div class='softMessage'>
            <span>{#thanksForYourConfirmation#}</span>
            {#thanksForYourConfirmationExplanation#}
            <br/>
            <br/>
            <center>
              <a class='button' href="confirm/{$proposals[pr].cod}">{#reviewConfirmation#}</a>
            </center>
          </div>
        {else}
          <div class='message'>
            <span>{#confirmationNeeded#}</span>
            {#confirmationNeededExplanation#}
            <br/>
            <br/>
            <center>
              <a class='button' href="confirm/{$proposals[pr].cod}">{#confirm#}</a>
            </center>
          </div>
        {/if}
      {/if}
    </div>
    <div>
      {if $proposals[pr].tipo == 's'}
        <a href="reviews/{$proposals[pr].cod}">{#viewReviews#}</a>
        {if $proposals[pr].status == 'd'}
        (<em>{#viewReviewsGaveUpNote#}</em>)
        {/if}
      {/if}
    </div>
  <!-- ***************************************** -->
  <!-- end of RESULTS -->
  <!-- ***************************************** -->
  {/if}
</div>
{/section}
