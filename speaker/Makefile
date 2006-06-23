all: build runtime

build: css img js
	make -C include/

img js:
	ln -sf ../$@ .

runtime: templates_c

templates_c:
	mkdir $@
	chmod 777 $@

css:
	ln -s ../admin/css .

clean:
	rm -rf templates_c css img js
	make clean -C include
