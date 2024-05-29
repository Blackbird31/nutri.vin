.PHONY: test all

.DEFAULT_GOAL := all

all: update_trad

update_trad:
	# Extraction des phrases traductibles...
	@xgettext --from-code=utf-8 --no-location --output=./locale/application.pot app/views/qrcode_show.html.php app/models/QRCode.class.php

	# Mise a jour des fichiers .po...
	@for lang in $$(find locale -mindepth 1 -maxdepth 1 -type d); do \
    	po_file="$$lang/LC_MESSAGES/application.po"; \
		msgmerge --update -N "$$po_file" ./locale/application.pot; \
	done

	# Creation des fichiers .mo...
	@for lang in $$(find locale -mindepth 1 -maxdepth 1 -type d); do \
        po_file="$$lang/LC_MESSAGES/application.po"; \
        rm -f "$$lang/LC_MESSAGES/application.mo"; \
        msgfmt "$$po_file" --output-file="$$lang/LC_MESSAGES/application.mo"; \
		git add "$$lang/LC_MESSAGES/application.mo"; \
    done
