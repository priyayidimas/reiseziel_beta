$(document).ready(function () {
    $('input.bandara').autocomplete({
        data: {
          "BDO - Bandung": null,
          "CGK - Tangerang": null,
          "HLP - Jakarta": null,
          "JOG - Yogyakarta": null,
          "SRG - Semarang": null,
          "SUB - Surabaya": null,
          "DPS - Denpasar": null,
          "LOP - Lombok": null,
          "KOE - Kupang": null,
          "TKG - Bandar Lampung": null,
          "BTH - Batam": null,
          "BTJ - Banda Aceh": null,
          "MES - Medan": null,
          "PDG - Padang Pariaman": null,
          "PKU - Pekanbaru": null,
          "TNJ - Tanjungpinang": null,
          "PNK – Pontianak" : null,
          "BPN – Balikpapan" : null,
          "TRK – Tarakan" : null,
          "MDC - Manado" : null,
          "UPG - Maros" : null,
          "BUW - Baubau" : null,
          "DJJ - Jayapura" : null,
          "AMQ - Ambon" : null,
          "MKQ - Merauke" : null
        },
        limit: 3, // The max amount of results that can be shown at once. Default: Infinity.
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
      });

    $('input.stasiun').autocomplete({
        data: {
          "Bandung": null,
          "Tangerang": null,
          "Jakarta": null,
          "Yogyakarta": null,
          "Semarang": null,
          "Surabaya": null,
          "Garut": null,
          "Tasikmalaya": null,
          "Cilacap": null,
          "Purwakarta": null,
          "Banjar": null,
          "Bogor": null,
          "Solo": null,
          "Blitar": null,
          "Purwokerto": null,
          "Kediri": null,
          "Banyuwangi": null,
          "Malang": null,
          "Jepara": null,
          "Pandeglang": null,
          "Wonosobo": null,
          "Kudus": null,
        },
        limit: 3, // The max amount of results that can be shown at once. Default: Infinity.
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
      });
    
});