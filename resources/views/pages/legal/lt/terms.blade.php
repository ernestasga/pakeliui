@extends('layouts.app')

@section('content')
<div class="jumbotron hero-2">
    <div class="container">
        <h1 class="display-4 text-center my-5">{{__('legal.terms_of_service')}}</h1>
    </div>
</div>
<div class="container">
    <h1>Svetainės naudojimo sąlygos</h1>

<h2>1. Sąlygos</h2>

<p>
    Prisijungdami prie šios interneto svetainės, pasiekiamos adresu {{config('app.url')}} ir ją naudodamiesi, Jūs sutinkate ir patvirtinate, kad teisiškai, be jokių apribojimų ir išlygų, įsipareigojate laikytis šių sąlygų ir taisyklių.
    Interneto svetaine galite naudotis, jei visiškai sutinkate su šiomis svetainės naudojimo sąlygomis ir taisyklėmis. Jeigu su sąlygomis ir taisyklėmis nesutinkate, interneto svetaine nesinaudokite!
</p>

<h2>2. Naudojimo licenzija</h2>

<p>
    Suteikiamas leidimas laikinai atsisiųsti vieną medžiagos kopiją "{{config('app.name')}}" svetainėje tik asmeniniam, nekomerciniam, laikinam žiūrėjimui.
     yra licencijos suteikimas, o ne nuosavybės teisės perdavimas, ir pagal šią licenciją jūs negalite:
</p>


<ul>
    <li>keisti ar nukopijuoti medžiagą;</li>
    <li>bandyti pakeisti bet kokią "{{config('app.name')}}" svetainėje esančią programinę įrangą</li>
    <li>pašalinti autorių teisių ar kitų nuosavybės teisių turinčius užrašus;</li>
    <li>perduoti medžiagą kitam asmeniui arba „atspindėti“ medžiagą bet kuriame kitame serveryje.</li>
</ul>

<p>
    Tai leis "{{config('app.name')}}" nutraukti pažeidus bet kurį iš šių apribojimų. Nutraukus jūsų žiūrėjimo teisę, taip pat bus panaikinta ir turėtumėte
    sunaikinti visą savo turimą atsisiųstą medžiagą, nesvarbu, ar ji spausdinta, ar elektronine forma.
</p>

<h2>3. Atsakomybės apribojimas</h2>

<p>
    Visa medžiaga "{{config('app.name')}}" svetainėje pateikiama tokia, kokia yra. "{{config('app.name')}}" neteikia jokių garantijų, gali būti išreikšta ar numanoma, todėl paneigia visas kitas garantijas. Be to, "{{config('app.name')}}" nepareiškia
    jokių pretenzijų dėl medžiagos naudojimo savo svetainėje tikslumo ar patikimumo ar kitaip susijusios su tokia medžiaga ar bet kuriomis su šia svetaine susijusiomis svetainėmis.
</p>

<h2>4. Apribojimai</h2>

<p>
    "{{config('app.name')}}" ar jos tiekėjai nebus atsakingi už jokią žalą, atsirandančią naudojant ar nesugebant naudoti „PAKELIUI“ svetainėje esančios medžiagos, net jei apie tai "{{config('app.name')}}" ar šios svetainės įgaliotam atstovui buvo pranešta žodžiu ar raštu.
</p>

<h2>5. Pataisymai ir klaidos</h2>

<p>
    "{{config('app.name')}}" svetainėje rodomoje medžiagoje gali būti techninių, spausdinimo ar fotografijos klaidų. "{{config('app.name')}}" nežada, kad kuri nors šios svetainės medžiaga yra tiksli, išsami ar aktuali.
    "{{config('app.name')}}" gali bet kuriuo metu be išankstinio įspėjimo pakeisti savo interneto svetainėje esančią medžiagą. "{{config('app.name')}}" neįsipareigoja atnaujinti medžiagos.
</p>

<h2>6. Nuorodos</h2>

<p>
    "{{config('app.name')}}" neperžiūrėjo visų su savo svetaine susietų svetainių ir neatsako už tokios susietos svetainės turinį. Bet kokia nuoroda nereiškia, kad "{{config('app.name')}}" pritaria svetainei. Bet kurios susietos svetainės naudojimas yra vartotojo pačių rizika.
</p>

<h2>7. Svetainės naudojimo sąlygų pakeitimai</h2>

<p>
    "{{config('app.name')}}" gali bet kuriuo metu be išankstinio įspėjimo peržiūrėti šias savo svetainės naudojimo sąlygas. Naudodamiesi šia svetaine sutinkate laikytis dabartinės šių naudojimo sąlygų versijos.
</p>

<h2>8.Jūsų privatumas</h2>

<p>Perskaitykite mūsų <a href="{{route('legal.privacy')}}">{{__('legal.privacy_policy')}}</a>.</p>

<h2>9. Governing Law</h2>

<p>
    Bet kokioms pretenzijoms, susijusioms su "{{config('app.name')}}" interneto svetaine, taikomi jos įstatymai, neatsižvelgiant į jos kolizines nuostatas.</p>
</div>

@endsection
