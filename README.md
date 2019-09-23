# Ligonines-Projektas
Ligoninės projektas NFQ akademijos backend užduočiai

Minimalus užduoties įgyvendimas ( Level 1 )
===============================
Pridėta kataloge level 1

Švieslentę galima pamatyti faile index.php, ten taip pat yra mygtukas nuvedadantis į "paciento" registraciją.

Norit peržiūrėti specialisto dalį, reikia nueiti į signin.php failą, ten siūlo prisijungti, galima arba duombazėje pridėti naują įrašą, arba pasinaudoti kažkuriuo iš SQL dumpo(jų visų slaptažodis yra password), o loginai duombazėje. Ten prisijungus tada galima peržiūrėti visus specialistui priskirtus pacientus ir juos "patvirtinti".

**Užduočių įgyvendinimas**

> Yra failas duomenų bazės struktūrai

  Buvo įgyvendinta pridedant SQL duomenų bazės dump'ą, jame matosi visi primary, foreign key, bei duomenų bazės lentelės bei jų laukai.

> Yra failas prisijungimui prie duomenų bazės ( config file )

  Buvo įgyvendinta Database.php klasės faile, kadangi buvo naudota localhost duomenų bazė, tai jungiantis reikia įvesti savo lokalios bazės username, password bei duomenų bazės schemos pavadinimą.

> Panaudotas POST HTTP metodas

  Buvo įgyvendinta kuriant naują registraciją.

> Panaudotas GET HTTP metodas

  Buvo įgyvendinta atvaizduojant koki žmonės užsiregistravo pas specialistą.

> Įrašoma į duomenų bazę

  Buvo įgyvendinta kartu su POST metodu įrašant naujas registracijas į duomenų bazę.

> Skaitoma iš duomenų bazės (su rikiavimu)

  Buvo įgyvendinta atvaizduojant švieslentėje, bei specialisto puslapyję esančius įrašus rikiuojant pagal jų registracijos laiką.

> Ištrinimas iš duomenų bazės (WHERE sąlyga) 

  Buvo įgyvendinta kai specialistas paspausdavo mygtuką, kad aptarnavo klientą.

> Keli būdai atvaizduoti tuos pačius duomenis (LIMIT sąlyga) 

  Buvo įgyvendinta atvaizduojant įrašus švieslentėje, limituojant įrašų kiekį iki naujausių 10 (kas galbūt nėra reikalinga)

> Panaudota sudėtingesnė SQL struktūra (kelios lentelės susietos ryšiais (1:daug))

  Buvo įgyvendinta susiejant lenteles client bei specialist su registration. Lentelėje registration yra foreign key į lenteles client bei specialist.

Rekomenduojamas užduoties įgyvendimas ( Level 2 )
===============================

Pridėta kataloge level 2

Projektas buvo papildytas keliais failais. CompletionTime klase, kurioje aprašomi veiksmai su duombazėje esančia lentele completion_time, view.php į kurį klientas yra nukreipiamas po registracijos ir kuris atstovauja jo asmeninį puslapį, bei 404.php kuriame yra turinys kurį rodo jeigu nepavyksta klientui prisijungti prie savo "paskyros" kurioje rodo jo laukimo laiką.

**Užduočių įgyvendinimas**

> Specialistui aptarnavus klientą, vietoj duomenų ištrynimo, pažymima, kad klientas aptarnautas

  Buvo įgyvendinta duomenų bazės lentelėje pridėjus lauką "is_completed" su galimomis reikšmėmis 0 ir 1, kur 1 žymi, kad klientas buvo aptarnautas. Specialistas spaudžiant mygtuką baigti, vietoj ištrinimo lauko iš registration lentelės dabar tik atnaujina is_completed reikšmę į 1.

> Švieslentėje rodomi tik neaptarnauti klientai

  Buvo įgyvendinta atnaujinus užklausą, kad trauktų visas registracijas kurių statusas yra 0 arba neaptarnauti.

> Yra funkcija ar SQL užklausa apskaičiuoti, kiek truko apsilankymas (galima apsilankymų laikus saugoti atskiroje lentelėje)
  
  Buvo įgyvendinta paimant skirtumą timestampo registracijos ir kada buvo aptarnautas klientas ir įrašant į duombazę kaip naują įrašą priskiriant registracijos id.

> Švieslentėje rodoma, kiek laiko liko klientui laukti (vidurkis pagal laukimo laiką per specialistą)

  Buvo įgyvedinta pradžiai apskaičiuojant kelintas eilėje klientas yra pas specialistą, tada padauginant iš specialisto vidutinio aptarnavimo laiko.

> Lankytojas gavęs nuorodą (ar įvedęs savo numerį kažkokioje formoje) mato tik jam skirtą laukti laiką
  
  Buvo įgyvendinta sukuriant naują php failą view.php. Įkėlimo į duombazę metu yra sugeneruojamas hash string'as kuris yra įdedamas į duombazę ir poto naudojamas kaip argumentas view.php faile, kad rodyti žmogui jo vidutinį laukimo laiką. Tada žmogus kai registruojasi sėkmingos registracijos metu jis yra nukeliamas į view.php failą su jam sugeneruotu url kaip argumentu ir ten jis gali išsisaugoti nuorodą tolimensniam vartojimui arba grįžti į pagrindinį puslapį.

> Lankytojo puslapyje numatomas laikas patikslinamas kas 5s (JavaScript arba HTML meta)

  Buvo įgyvendinta pridedant html meta tag'ą.

> Užregistravus naują klientą turi išvesti Užregistruota sėkmingai arba Įvyko klaida, kreipkitės telefonu

  Sėkmingai užsiregistravus žmogus yra perkeliamas į view.php failą kuriame yra išvesta žinutė pranešanti, kad sėkmingai užsiregistravo, kitu atveju yra perkeliamas į 404.php kuriame išvedamas pranešimas "Įvyko klaida, kreipkitės telefonu"
