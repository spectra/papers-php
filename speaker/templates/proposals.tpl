<h2>{#yourProposals#}</h2>
{section loop=$proposals name=pr}
<div class='proposalBox'>
  <h3>
    {$proposals[pr].titulo}
    {if $submissionPeriod == 'submission'}
      <a style='font-size: smaller' href="submit/{$proposals[pr].cod}">({#edit#})</a>
      <a style='font-size: smaller' href="submitRemove/{$proposals[pr].cod}">({#remove#})</a>
    {/if}
  </h3>
  <div>
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
    {if $proposals[pr].status == 'c'}
    {#invited#}
    {/if}
    </span>
  </div>
  <div>
    {if $proposals[pr].status == 'a' || $proposals[pr].status == 'p' || $proposals[pr].status == 'c'}
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
    {if $proposals[pr].status == 'a' || $proposals[pr].status == 'p' || $proposals[pr].status == 'r' || $proposals[pr].status == 'd'}
      <a href="reviews/{$proposals[pr].cod}">{#viewReviews#}</a>
      {if $proposals[pr].status == 'd'}
      (<em>{#viewReviewsGaveUpNote#}</em>)
      {/if}
    {/if}
  </div>
</div>
{/section}
