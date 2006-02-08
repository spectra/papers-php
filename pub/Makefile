#PHP=grade.php
INCLUDES=mysql.inc.php basic.inc.php grade.inc.php dias.inc.php horarios.inc.php salas.inc.php propostas.inc.php pessoas.inc.php macrotemas.inc.php press.inc.php config.inc.php mysmarty.inc.php
TEMPLATES=grade.tpl

all: build runtime

build: $(PHP) $(TEMPLATES) includes img
	if [ ! -e index.php ]; then ln -s programacao.php index.php; fi

runtime: templates_c 

img:
	ln -sf ../img .

templates_c:
	mkdir $@
	chmod 777 $@

includes:
	cd include; for each in $(INCLUDES); do if [ ! -e $$each ]; then ln -s ../../admin/include/$$each ; fi; done

#%.php:
#	if [ ! -e $@ ]; then ln -s ../admin/$@; fi

%.tpl:
	cd templates; if [ ! -e $@ ]; then ln -s ../../admin/templates/$@ .; fi

clean:
	rm -rf templates_c index.php
	rm -f $(PHP)
	cd templates; rm -f $(TEMPLATES)
	cd include; rm -f $(INCLUDES)
	rm -f img
