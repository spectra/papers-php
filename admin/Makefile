all: build runtime

build: css

runtime: templates_c log

templates_c log:
	mkdir $@
	chmod 777 $@

css:
	ln -sf ../css .

clean:
	rm -rf templates_c log css
