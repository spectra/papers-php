TEMPLATES=login.tpl footer.pt-br.tpl footer.en.tpl personalInfo.tpl tracks.tpl lostPassword1.tpl lostPassword2.pt-br.tpl lostPassword2.en.tpl newPassword.pt-br.tpl newPassword.en.tpl

build: $(TEMPLATES)

$(TEMPLATES):
	ln -s ../../speaker/templates/$@ .

runtime:

clean:
	rm -rf $(TEMPLATES)
