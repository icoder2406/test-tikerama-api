<x-mail::message>
# Bienvenu M./Mme {{ $data['first_name'] }} <span style="text-transform: uppercase">{{ $data['last_name'] }}</span>

Nous sommes ravis de vous compter parmis nos précieux clients. Veillez trouver en fichier joint, la documentation
de notre API.
<br>
Pour tout autre besoin, contacter nous.
<br><br>

<br>
<x-mail::button :url="'https://github.com/icoder2406/test-tikerama-api/blob/main/public/docs/API-Documentation.pdf'">
Télécharger la documentation ici
</x-mail::button>

Merci,<br>
{{ config('app.name') }}
</x-mail::message>
