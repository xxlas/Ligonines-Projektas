# Ligonines-Projektas
Ligoninės projektas NFQ akademijos backend užduočiai

Minimalus užduoties įgyvendimas ( Level 1 )
===============================
Pridėta kataloge level 1

Švieslentę galima pamatyti faile index.php, ten taip pat yra mygtukas nuvedadantis į "paciento" registraciją.

Norint peržiūrėti specialisto dalį, reikia nueiti į signin.php failą, ten siūlo prisijungti, galima arba duombazėje pridėti naują įrašą, arba pasinaudoti kažkuriuo iš SQL dumpe esančių loginų(jų visų slaptažodis yra password). Prisijungus tada galima peržiūrėti visus specialistui priskirtus pacientus ir juos "patvirtinti".

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

  Buvo įgyvendinta atvaizduojant švieslentėje, bei specialisto puslapyję esančius įrašus, rikiuojant pagal jų registracijos laiką.

> Ištrinimas iš duomenų bazės (WHERE sąlyga) 

  Buvo įgyvendinta kai specialistas paspaudžia mygtuką, kad aptarnavo klientą.

> Keli būdai atvaizduoti tuos pačius duomenis (LIMIT sąlyga) 

  Buvo įgyvendinta atvaizduojant įrašus švieslentėje, limituojant įrašų kiekį iki naujausių 10 (kas galbūt nėra reikalinga)

> Panaudota sudėtingesnė SQL struktūra (kelios lentelės susietos ryšiais (1:daug))

  Buvo įgyvendinta susiejant lenteles client bei specialist su registration. Lentelėje registration yra foreign key į lenteles client bei specialist.

Rekomenduojamas užduoties įgyvendimas ( Level 2 )
===============================

Pridėta kataloge level 2

Projektas buvo papildytas keliais failais. CompletionTime klase, kurioje aprašomi veiksmai su duombazėje esančia lentele completion_time, view.php į kurį klientas yra nukreipiamas po registracijos ir kuris atitinka jo asmeninį puslapį, bei 404.php kuriame yra turinys, kurį rodo, jeigu nepavyksta klientui prisijungti prie savo "paskyros" kurioje rodo jo laukimo laiką.

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
  
  Buvo įgyvendinta sukuriant naują php failą view.php. Įkėlimo į duombazę metu yra sugeneruojamas hash string'as kuris yra įdedamas į duombazę ir poto naudojamas kaip argumentas view.php faile, kad rodyti žmogui jo vidutinį laukimo laiką. Tada žmogus kai registruojasi sėkmingos registracijos metu jis yra nukreipiamas į view.php failą su jam sugeneruotu url kaip argumentu ir ten jis gali išsisaugoti nuorodą tolimesniam vartojimui arba grįžti į pagrindinį puslapį.

> Lankytojo puslapyje numatomas laikas patikslinamas kas 5s (JavaScript arba HTML meta)

  Buvo įgyvendinta pridedant html meta tag'ą kuris atnaujina puslapį kas 5 sekundes.

> Užregistravus naują klientą turi išvesti Užregistruota sėkmingai arba Įvyko klaida, kreipkitės telefonu

  Sėkmingai užsiregistravus žmogus yra perkeliamas į view.php failą kuriame yra išvesta žinutė pranešanti, kad sėkmingai užsiregistravo, kitu atveju yra perkeliamas į 404.php kuriame išvedamas pranešimas "Įvyko klaida, kreipkitės telefonu"
  
  
Galimas užduoties praplėtimas ( Level 3 )
===============================

Pridėta kataloge Level 3

Į projektą prisidėjo dar keli failiukai. cancel.php failas skirtas atšaukti registracijoms, delay.php failas skirtas atidėti registracijoms, bei stats.php kur yra pavaizduota statistika specialistų su jų aptarnautais žmonėmis per dieną bei jų vidutiniu greičiu.

**Užduočių įgyvendinimas**

> Apsilankymų laikas grupuojamas pagal dienas (SQL) 

Buvo įgyvendinta parašant užklausa kuri sugrupuoja registracijas pagal specialistą tam tikromis dienomis ir atvaizduojant tą informaciją statistikos puslapyje.

> Statistikoje galima uždėti filtrą konkretiems specialistams

Buvo įgyvendinta su jQuery pagalba taip pat statistikos puslapyje. Galima galbūt būtų buvę ir su PHP parašyti, bet specifikacijoje nebuvo nurodyta, o ir su jQuery daug paprasčiau tiesiog užslėpti elementus.

> Lankytojui sugeneruojama unikali nuoroda į lankytojo puslapį (kad apsaugoti URL atspėjimą)

Buvo įgyvendita realiai jau level 2 sprendime. Tiesiog prieš įdedant registraciją į duomenų bazę buvo sugeneruotas 8 simbolių ilgio kodukas kuris veiks kaip url tik aktyviems klientams. Tuomet kai įrašas yra atiduodamas į duomenų bazę tas URL yra returninamas atgal į kodą ir sugeneruoja adresą į kurį klientas yra nukreipiamas.

> Lankytojas mato mygtuką pavėlinti (sukeičia su už juo esančiu žmogumi)

Buvo įgyvendinta sukuriant mygtuką view.php faile kur klientas peržiūri savo registracijos informaciją. Kai klientas paspaudžia mygtuka tiesiog yra įvykdomas dvigubas update, kur yra sukeičiamos kliento ir žemiau jo esančio eilėje kliento registracijos datos.

> Pavėlinimas negalimas, jei lankytojas yra paskutinis eilėje

Buvo įgyvendinta atliekant patikrinimą prieš užkraunant puslapį view.php. Jeigu lankytojas yra vienas eilėje arba paskutinis, tai jis nemato mygtuko kuris galėtų jį nustumti žemiau.

> Lankytojas gali atšaukti susitikimą pas specialistą (PHP + SQL)

Buvo įgyvendinta pridedant dar vieną atskirą skaičių prie statuso completed_at. Jeigu tas laukas yra = 2, tai reiškia, kad klientas atšaukė registraciją. Kadangi visur sąrašuose yra traukiami žmonės tik su statusu = 0, tai niekas neturėtų keistis.

> Įvedamų duomenų validavimas PHP pusėje Vardenis( data validation )

Buvo įgyvendinta pasinaudojant php funkcija ctype_alnum kuris nepraleidžia jokių simbolių išskyrus raides ir skaičius. Galbūt nėra visiškai teisingas įrankis šitam dalykui, bet teoriškai vesti turėtų tik vardą, tai neturėtų būti nei skaičių nei simbolių, taigi reiktų keisti priklausomai nuo to ką ten veda.

> Po duomenų validavimo PHP pusėje forma turi išlaikyti užpildytą informaciją

Buvo įgyvendinta kai įvykus nesėkmingam duomenų validavimui yra atiduodama lauko reikšmė url adrese, tada yra išvedamas atgal į vardo įvedimo lauką.
