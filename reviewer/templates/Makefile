TEMPLATES=login.tpl footer.pt-br.tpl footer.en.tpl personalInfo.tpl tracks.tpl

build: $(TEMPLATES)

$(TEMPLATES):
	ln -s ../../speaker/templates/$@ .

runtime:

clean:
	rm -rf $(TEMPLATES)
