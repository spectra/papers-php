PACKAGE = papers
VERSION = 0.4.0

IMG=$(patsubst %.svg,%.png,$(wildcard *.svg))

all: build runtime

build: $(IMG)
	make build -C pub/
	make build -C speaker/
	make build -C reviewer/
	make build -C admin/

runtime:
	make runtime -C pub/
	make runtime -C speaker/
	make runtime -C reviewer/
	make runtime -C admin/
	make runtime -C ext/
	make upload

upload:
	mkdir $@
	chmod 777 $@ || rmdir upload
	@echo "***********************************************"
	@echo "*WARNING: upload/ directory has permissions 777"
	@echo "*WARNING: YOU SHOULD REALLY FIX THIS, BY ISSUING:"
	@echo "*WARNING: chown webserveruser:webservergroup upload/"
	@echo "*WARNING: chmod 700 upload/"
	@echo "*WARNING: Where:"
	@echo "*WARNING: webserveruser = user that owns the webserver's processes"
	@echo "*WARNING: webservergroup = group to which the webserver's processes are bound"
	@echo "***********************************************"



%.png: %.svg
	-rsvg $< $@

###### DISTRIBUTION ######

DISTDIR = $(PACKAGE)-$(VERSION)
TARBALL = $(DISTDIR).tar.gz
CURDIR = $(shell pwd)
FULLPACKAGE=$(PACKAGE)-$(VERSION)-full
FULLPACKAGETARBALL=$(FULLPACKAGE).tar.gz

dist: clean
	mkdir /tmp/$(DISTDIR)
	cp -r `ls -1 | grep -v $(TARBALL)` /tmp/$(DISTDIR)
	(cd /tmp/$(DISTDIR); rm -rf debian `find . -name .svn`)
	(cd /tmp/$(DISTDIR); rm -rf upload ext)
	(cd /tmp; tar czf $(CURDIR)/$(TARBALL) $(DISTDIR))
	rm -rf /tmp/$(DISTDIR)
	
dist-full: clean all
	mkdir /tmp/$(FULLPACKAGE)
	cp -r * /tmp/$(FULLPACKAGE)
	(cd /tmp/$(FULLPACKAGE); rm -rf debian `find . -name .svn`)
	(cd /tmp/$(FULLPACKAGE); rm -rf upload)
	(cd /tmp/$(FULLPACKAGE); rm -rf ext/*.tar.gz ext/*.tgz)
	# -h to make tar derreference symlinks
	# -p to preserve premissions
	(cd /tmp; tar czfhp $(CURDIR)/$(FULLPACKAGETARBALL) $(FULLPACKAGE))
	rm -rf /tmp/$(FULLPACKAGE)


SVNROOT=https://svn.softwarelivre.org/svn/papers
svntag:
	if [ "`svn ls $(SVNROOT)/tags/$(VERSION) 2>/dev/null`" ]; then echo "this version ($(VERSION)) was already tagged"; exit 1; fi
	svn copy $(SVNROOT)/trunk $(SVNROOT)/tags/$(VERSION)

###### DEBIAN PACKAGING #####

DEBIAN_ORIG = $(PACKAGE)_$(VERSION).orig.tar.gz
DEBIAN_BUILD = debian-build-area
DEBIAN_OPTS=-us -uc

deb: dist $(DEBIAN_BUILD)
	cp $(TARBALL) $(DEBIAN_BUILD)/$(DEBIAN_ORIG)
	(cd $(DEBIAN_BUILD) ; tar xzf $(DEBIAN_ORIG))
	cp -r debian $(DEBIAN_BUILD)/$(DISTDIR)/
	rm -rf $(DEBIAN_BUILD)/$(DISTDIR)/debian/.svn
	(cd $(DEBIAN_BUILD)/$(DISTDIR)/; dpkg-buildpackage -rfakeroot $(DEBIAN_OPTS))
	(cd $(DEBIAN_BUILD); lintian -iI *.changes)
	(cd $(DEBIAN_BUILD); linda -C E,W *.changes)
	@echo -e "\033[41;01mDebian package is under $(DEBIAN_BUILD)/ directory!\033[m"

$(DEBIAN_BUILD):
	rm -rf $(DEBIAN_BUILD)/*
	mkdir -p $@

ext-clean:
	make clean -C ext/

clean:
	rm -rf *.tar.gz $(DEBIAN_BUILD)
	for each in `find -type d -name templates_c`; do rm -f $$each/*; done
	rm -rf $(IMG)
	rm -f $(TARBALL) $(FULLPACKAGETARBALL)
	make clean -C pub/
	make clean -C speaker/
	make clean -C reviewer/
	make clean -C admin/
	@rmdir upload/ && echo "removed upload/" || echo "*********************************" && echo "*WARNING: upload/ not empty, not removing." && echo "*********************************"
