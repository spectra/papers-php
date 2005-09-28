all: templates_c css img
	make -C include/

img:
	ln -sf ../img .

templates_c:
	mkdir $@
	chmod 777 $@

css:
	ln -s ../admin/css .

clean:
	rm -rf templates_c css img
	make clean -C include
