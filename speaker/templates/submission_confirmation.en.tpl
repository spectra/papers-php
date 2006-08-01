Dear {$person.nome},

Your submission for "{$event.name}",
with title "{$proposal.titulo}",
was received for evaluation.

{if $event.allow_submission_update}
Before the submissin deadline, you can update your submission
through the website:
{$event.papers_url}/speaker/
{/if}

If the submission was done by you, you already have your password. Otherwise,
you can use the "I forgot my password" option to receive a new password by
e-mail.

--
{$event.name}
Contact e-mail: {$event.contact_email}
