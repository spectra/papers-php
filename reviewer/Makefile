all: build runtime

PHPS=logout.php account.php accountSave.php tracks.php personalInfo.php personalInfoSave.php lostPassword.php

build: css img configs include $(PHPS)
	make build -C templates/

img:
	ln -sf ../img .

runtime: templates_c

templates_c:
	mkdir $@
	chmod 777 $@

css:
	ln -s ../admin/css .

configs:
	ln -s ../speaker/configs .

include:
	ln -s ../speaker/include .

$(PHPS):
	ln -s ../speaker/$@ .

clean:
	rm -rf templates_c css img configs include $(PHPS)
	make clean -C templates/
