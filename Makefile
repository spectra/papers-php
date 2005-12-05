PACKAGE = papers
VERSION = 0.3.1

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

%.png: %.svg
	rsvg $< $@

###### DISTRIBUTION ######

DISTDIR = $(PACKAGE)-$(VERSION)
TARBALL = $(DISTDIR).tar.gz
CURDIR = $(shell pwd)

dist: clean
	mkdir /tmp/$(DISTDIR)
	cp -r `ls -1 | grep -v debian | grep -v $(TARBALL)` /tmp/$(DISTDIR)
	(cd /tmp; tar czf $(CURDIR)/$(TARBALL) $(DISTDIR))
	rm -rf /tmp/$(DISTDIR)
	

###### DEBIAN PACKAGING #####

DEBIAN_ORIG = $(PACKAGE)_$(VERSION).orig.tar.gz
DEBIAN_BUILD = debian-build-area

deb: dist $(DEBIAN_BUILD)
	cp $(TARBALL) $(DEBIAN_BUILD)/$(DEBIAN_ORIG)
	(cd $(DEBIAN_BUILD) ; tar xzf $(DEBIAN_ORIG))
	cp -r debian $(DEBIAN_BUILD)/$(DISTDIR)/
	(cd $(DEBIAN_BUILD)/$(DISTDIR)/; dpkg-buildpackage -rfakeroot $(DEBIAN_OPTS))
	@echo -e "\033[41;01mDebian package is under $(DEBIAN_BUILD)/ directory!\033[m"

$(DEBIAN_BUILD):
	rm -rf $(DEBIAN_BUILD)/*
	mkdir -p $@

clean:
	rm -rf $(TARBALL) $(DEBIAN_BUILD)
	for each in `find -type d -name templates_c`; do rm -f $$each/*; done
	rm -rf $(IMG)
	make clean -C pub/
	make clean -C speaker/
	make clean -C reviewer/
	make clean -C admin/
