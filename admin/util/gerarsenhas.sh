#!/bin/sh

EMAIL_ORGANIZAZAO=temario@softwarelivre.org
LOGIN=blabla

HTPASSWDFILE=$1
if [ "$HTPASSWDFILE" == "" ]
then
  echo "uso: $0 <arquivo-htpasswd> [-b]"
  echo "Opções:"
  echo "-b      não mostra as perguntas (use quando for passar a entrada por"
  echo "        um pipe."
  exit 1
fi

HTPASSWDPROG=""
if [ -x /usr/bin/htpasswd ]
then
  HTPASSWDPROG=/usr/bin/htpasswd
fi

if [ -x /usr/bin/htpasswd2 ]
then
  HTPASSWDPROG=/usr/bin/htpasswd2
fi

if [ "$HTPASSWDPROG" == "" ]
then
  echo "Não encontrei o programa htpasswd para gerar o arquivo de senhas."
  echo "O apache está instalado?"
  exit 2
fi

while [ true ]
do
  echo -n "Login (vazio pra terminar): "
  read LOGIN
  if [ "$LOGIN" == "" ]
  then
    exit 0
  fi

  echo -n "e-mail: "
  read EMAIL

  PASSWORD=`makepasswd`
  ANO=`date +%Y`

  $HTPASSWDPROG -b $HTPASSWDFILE $LOGIN $PASSWORD

mail -s "Temario do FISL $ANO" \
     -a "From: $EMAIL_ORGANIZAZAO" \
     -a "Content-Type: text/plain;charset=iso-8859-1" \
     $EMAIL \
<<EOF
Olá,

Seguem as informações para seu acesso à avaliação de propostas de
palestras no FISL $ANO.

Endereço: https://fisl.softwarelivre.org/papers/admin/avaliacao
   Login: $LOGIN
   Senha: $PASSWORD

Procure efetuar a avaliação das propostas dos macro-temas escolhidos
o mais rápido possível.

Saudações,

--
Organização do FISL $ANO
Contato: $EMAIL_ORGANIZAZAO
EOF
  
done
