SMARTY_VERSION=2.6.14
ADODB_VERSION=490

################################################

SMARTY_BASE=http://smarty.php.net/distributions/
SMARTY_TARBALL=Smarty-$(SMARTY_VERSION).tar.gz

ADODB_BASE=http://ufpr.dl.sourceforge.net/sourceforge/adodb/
ADODB_TARBALL=adodb$(ADODB_VERSION).tgz

runtime: smarty adodb

smarty:
	[ -e $(SMARTY_TARBALL) ] || wget $(SMARTY_BASE)/$(SMARTY_TARBALL)
	tar xzf $(SMARTY_TARBALL)
	mv Smarty-$(SMARTY_VERSION) smarty

adodb:
	[ -e $(ADODB_TARBALL) ] || wget $(ADODB_BASE)/$(ADODB_TARBALL)
	tar xzf $(ADODB_TARBALL)

clean:
	rm -rf smarty adodb

fullclean: clean
	rm -rf $(SMARTY_TARBALL)
	rm -rf smarty
	rm -rf $(ADODB_TARBALL)
	rm -rf adodb
