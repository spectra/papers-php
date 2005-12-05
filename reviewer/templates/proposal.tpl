<h3>{#intendedAudience#}</h3>
{$proposta.publicoalvo|regex_replace:"/\r\n\r\n|\n\n/":"<p/>"}

<h3>{#lectureDescription#}</h3>
{$proposta.descricao|regex_replace:"/\r\n\r\n|\n\n/":"<p/>"}

<h3>{#lectureAbstract#}</h3>
{$proposta.resumo|regex_replace:"/\r\n\r\n|\n\n/":"<p/>"}

<h3>{#comments#}</h3>
{$proposta.comentarios|regex_replace:"/\r\n\r\n|\n\n/":"<p/>"}


