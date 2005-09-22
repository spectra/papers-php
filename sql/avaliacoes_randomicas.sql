insert into avaliacoes (select cod, 'teste1', 0.5 + ceil(rand()*3)/2, ceil(rand() * 5), ceil(rand() * 5), ceil(rand() * 5), 1 + ceil(rand() * 4)/4, '', '' from propostas);

insert into avaliacoes (select cod, 'teste2', 0.5 + ceil(rand()*3)/2, ceil(rand() * 5), ceil(rand() * 5), ceil(rand() * 5), 1 + ceil(rand() * 4)/4, '', '' from propostas);

insert into avaliacoes (select cod, 'teste3', 0.5 + ceil(rand()*3)/2, ceil(rand() * 5), ceil(rand() * 5), ceil(rand() * 5), 1 + ceil(rand() * 4)/4, '', '' from propostas);

insert into avaliacoes (select cod, 'teste4', 0.5 + ceil(rand()*3)/2, ceil(rand() * 5), ceil(rand() * 5), ceil(rand() * 5), 1 + ceil(rand() * 4)/4, '', '' from propostas);

insert into avaliacoes (select cod, 'teste5', 0.5 + ceil(rand()*3)/2, ceil(rand() * 5), ceil(rand() * 5), ceil(rand() * 5), 1 + ceil(rand() * 4)/4, '', '' from propostas);

insert into avaliacoes (select cod, 'teste6', 0.5 + ceil(rand()*3)/2, ceil(rand() * 5), ceil(rand() * 5), ceil(rand() * 5), 1 + ceil(rand() * 4)/4, '', '' from propostas);

update avaliacoes set recomendacao = 1 where recomendacao = 1.25;
