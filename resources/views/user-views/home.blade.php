<x-user-components.layout>
    <x-user-components.image-slider :sliders="$sliders"></x-user-components.image-slider>
    <x-user-components.agenda :agendaHariIni="$agendaHariIni" :agendaBulanIni="$agendaBulanIni"></x-user-components.agenda>
    <x-user-components.news-home :beritaTerkini="$beritaTerkini" :dokumenTerbaru="$dokumenTerbaru"></x-user-components.news-home>
    <x-user-components.organizational-structure-home :pimpinanGrouped="$pimpinanGrouped"></x-user-components.organizational-structure-home>
    <x-user-components.album-home :albums="$albums"></x-user-components.album-home>
</x-user-components.layout>