<h2>Welcome</h2>

<p>
Hello, {$person.nome}.
</p>

{include file="proposalsSummary.tpl"}

{if count($proposals)}
<p>
It's necessary that you <a href="proposals">confirm</a> your participation in
the event, in order to make possible for the organization to allocate your
lecture(s) in the event's program grid.  Furthermore, it's important that you
double-check your <a href="personalInfo">personal info</a>.
</p>
<p>
<strong>Important:</strong>
The acceptance of your proposals <strong>doesn't</strong> imply that any of
your expenses with the event's attendance will be covered by the event,
<em>unless you are in touch with the organization and that was discussed and
approved by the organization.</em>
</p>
{/if}

<p>
You can check the reviews made to your proposals, starting from the
<a href='proposals'>proposals listing</a>.
</p>
