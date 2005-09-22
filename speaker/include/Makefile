COMMON=mysql.inc.php basic.inc.php config.inc.php

all: $(COMMON)

%.inc.php:
	ln -s ../../admin/include/$@ $@

clean:
	rm -f $(COMMON)
