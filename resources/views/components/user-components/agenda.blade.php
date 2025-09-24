@props(['agendaHariIni', 'agendaBulanIni'])
@php
    $initialAgendas = $agendaHariIni->merge($agendaBulanIni)->groupBy(function($item) {
        return (int)$item->tanggal->format('d');
    });
@endphp

<section class="agenda-component py-5" style="background-color: #f0f2f5;">
    <div class="container">
        <div class="agenda-container">
            <div class="agenda-details">
                <h2 class="fw-bold mb-4">Agenda Kegiatan</h2>
                <div id="agenda-list-dynamic" class="agenda-list-scrollable">
                </div>
            </div>

            <div class="calendar">
                <div class="calendar-header">
                    <button id="prev-month-btn" class="calendar-nav" aria-label="Bulan sebelumnya">&lt;</button>
                    <div id="calendar-month-year" class="month-year"></div>
                    <button id="next-month-btn" class="calendar-nav" aria-label="Bulan berikutnya">&gt;</button>
                </div>
                <div class="calendar-grid calendar-weekdays">
                    <div class="calendar-day-name">S</div>
                    <div class="calendar-day-name">S</div>
                    <div class="calendar-day-name">R</div>
                    <div class="calendar-day-name">K</div>
                    <div class="calendar-day-name">J</div>
                    <div class="calendar-day-name">S</div>
                    <div class="calendar-day-name">M</div>
                </div>
                <div id="calendar-days-dynamic" class="calendar-grid">
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .agenda-container { display: grid; grid-template-columns: 1fr 400px; gap: 2rem; background: #fff; padding: 2.5rem; border-radius: 1rem; border: 1px solid #dee2e6; align-items: start; }
    .calendar { background-color: #f8f9fa; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }
    .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .calendar-header .month-year { font-weight: 600; font-size: 1.2rem; }
    .calendar-nav { background: #e9ecef; border: none; width: 35px; height: 35px; border-radius: 50%; display: inline-flex; justify-content: center; align-items: center; transition: background-color 0.2s ease; cursor: pointer; }
    .calendar-nav:hover:not([disabled]) { background-color: #dde1e5; }
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem; }
    .calendar-weekdays { margin-bottom: 0.5rem; }
    .calendar-day, .calendar-day-name { text-align: center; padding: 0.25rem 0; }
    .calendar-day-name { font-weight: 600; color: #6c757d; font-size: 0.8rem; }
    
    .day-number { width: 38px; height: 38px; display: flex; justify-content: center; align-items: center; border-radius: 50%; cursor: pointer; transition: all 0.2s ease; margin: auto; position: relative; }
    .day-number:hover { background-color: #e2e6ea; }
    .day-number.today { background-color: #ffc107; color: #000; font-weight: bold; }
    .day-number.selected { background-color: #0d6efd; color: #fff; box-shadow: 0 0 0 2px white, 0 0 0 4px #0d6efd; }
    
    .day-number.has-agenda::after { content: ''; position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%); width: 5px; height: 5px; border-radius: 50%; background-color: #0d6efd; }
    .day-number.today.has-agenda::after { background-color: #000; }
    .day-number.selected.has-agenda::after { background-color: #fff; }

    .agenda-list-scrollable { max-height: 420px; overflow-y: auto; padding-right: 5px; }
    .agenda-list-scrollable::-webkit-scrollbar { display: none; }
    .agenda-list-scrollable { -ms-overflow-style: none;  scrollbar-width: none; }

    .agenda-details h5 { font-weight: 600; margin-bottom: 1rem; border-bottom: 2px solid #eee; padding-bottom: 0.5rem; }
    .single-agenda-item { margin-bottom: 0.25rem; padding-bottom: 0.25rem; }
    .agenda-item-header { cursor: pointer; padding: 0.5rem 0; position: relative; }
    .agenda-item-header::after { content: '\25BC'; font-size: 0.7em; color: #6c757d; position: absolute; right: 10px; top: 50%; transform: translateY(-50%) rotate(0deg); transition: transform 0.3s ease; }
    .single-agenda-item.active .agenda-item-header::after { transform: translateY(-50%) rotate(180deg); }
    
    /* Ganti warna teks waktu dan tanggal agenda di sini */
    .agenda-time-title strong {
        color: #000000;
        font-weight: bold;
    }

    .agenda-item-details { max-height: 0; overflow: hidden; transition: max-height 0.4s ease-in-out; }
    .single-agenda-item.active .agenda-item-details { max-height: 200px; padding-top: 0.5rem; }
    .agenda-location { font-size: 0.9em; color: #6c757d; }
    .agenda-location i { margin-right: 0.5em; width: 12px; text-align: center; }
    .agenda-description { font-size: 0.9em; color: #343a40; margin-top: 0.5rem; padding-left: 1.5rem; border-left: 2px solid #e9ecef; }

    @media (max-width: 768px) { 
        .agenda-container { 
            grid-template-columns: 1fr;
            padding: 1rem;
        } 
        
        .calendar { 
            order: 2;
            margin-top: 2rem; 
        }

        .agenda-details {
            order: 1; 
        }
        
        .agenda-list-scrollable { 
            max-height: none; 
            overflow-y: visible; 
        }

        .calendar {
            padding: 1rem;
        }
        
        .calendar-header .month-year {
            font-size: 1.1rem;
        }
        
        .calendar-nav {
            width: 32px;
            height: 32px;
        }
        
        .calendar-grid {
            gap: 0.25rem;
        }

        .day-number {
            width: 34px;
            height: 34px;
            font-size: 0.9rem;
        }

        .day-number.has-agenda::after {
            width: 4px;
            height: 4px;
            bottom: 4px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prevMonthBtn = document.getElementById('prev-month-btn');
    const nextMonthBtn = document.getElementById('next-month-btn');
    const monthYearDisplay = document.getElementById('calendar-month-year');
    const calendarDaysContainer = document.getElementById('calendar-days-dynamic');
    const agendaListContainer = document.getElementById('agenda-list-dynamic');

    let currentDate = new Date();
    let selectedDate = new Date();
    
    let agendas = {};
    const initialMonthKey = `${currentDate.getFullYear()}-${currentDate.getMonth()}`;
    agendas[initialMonthKey] = @json($initialAgendas);

    async function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const monthKey = `${year}-${month}`;

        if (!agendas[monthKey]) {
            await fetchAgendas(year, month + 1);
        }
        const currentMonthAgendas = agendas[monthKey] || {};

        monthYearDisplay.textContent = new Intl.DateTimeFormat('id-ID', { month: 'long', year: 'numeric' }).format(currentDate);

        calendarDaysContainer.innerHTML = '';
        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const startBlankDays = (firstDayOfMonth === 0) ? 6 : firstDayOfMonth - 1;
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();

        for (let i = 0; i < startBlankDays; i++) {
            calendarDaysContainer.insertAdjacentHTML('beforeend', '<div class="calendar-day"></div>');
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayEl = document.createElement('div');
            dayEl.className = 'calendar-day';
            dayEl.dataset.day = day;
            
            const dayNumberEl = document.createElement('div');
            dayNumberEl.className = 'day-number';
            dayNumberEl.textContent = day;

            if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                dayNumberEl.classList.add('today');
            }
            if (day === selectedDate.getDate() && month === selectedDate.getMonth() && year === selectedDate.getFullYear()) {
                dayNumberEl.classList.add('selected');
            }
            if (currentMonthAgendas[day]) {
                dayNumberEl.classList.add('has-agenda');
            }

            dayEl.appendChild(dayNumberEl);
            calendarDaysContainer.appendChild(dayEl);
        }

        renderAgendaDetails();
    }
    
    function renderAgendaDetails() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const monthKey = `${year}-${month}`;
        const currentMonthAgendas = agendas[monthKey] || {};
        let html = '';

        const today = new Date();
        if (month === today.getMonth() && year === today.getFullYear() && currentMonthAgendas[today.getDate()]) {
            html += `<h5>Agenda Hari Ini (${new Intl.DateTimeFormat('id-ID', { dateStyle: 'long' }).format(today)})</h5>`;
            currentMonthAgendas[today.getDate()].forEach(agenda => {
                html += formatAgendaItem(agenda);
            });
            html += '<hr class="my-4">';
        }

        const monthName = new Intl.DateTimeFormat('id-ID', { month: 'long' }).format(currentDate);
        html += `<h5>Semua Agenda Bulan ${monthName}</h5>`;

        const sortedDays = Object.keys(currentMonthAgendas).sort((a, b) => a - b);

        if (sortedDays.length > 0) {
            sortedDays.forEach(day => {
                currentMonthAgendas[day].forEach(agenda => {
                    const agendaDate = new Date(agenda.tanggal);
                    const formattedDate = new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'short' }).format(agendaDate);
                    html += formatAgendaItem(agenda, formattedDate);
                });
            });
        } else {
            html += `<p class="text-muted">Tidak ada agenda terjadwal untuk bulan ini.</p>`;
        }
        
        agendaListContainer.innerHTML = html;
    }

    function formatAgendaItem(agenda, prefix = null) {
        const time = new Date(`1970-01-01T${agenda.waktu}`).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        const prefixHtml = prefix ? `<strong>${prefix}:</strong> ` : '';
        
        let detailsHtml = '';
        if (agenda.lokasi) {
            detailsHtml += `<p class="agenda-location"><i class="fas fa-map-marker-alt"></i> ${agenda.lokasi}</p>`;
        }
        if (agenda.deskripsi) {
            const formattedDeskripsi = agenda.deskripsi.replace(/\n/g, '<br>');
            detailsHtml += `<div class="agenda-description">${formattedDeskripsi}</div>`;
        }
        
        let itemHtml = `<div class="single-agenda-item">`;
        itemHtml += `<div class="agenda-item-header">`;
        itemHtml += `<p class="agenda-time-title">${prefixHtml}<strong>${time}</strong> - ${agenda.judul}</p>`;
        itemHtml += `</div>`;
        itemHtml += `<div class="agenda-item-details">${detailsHtml}</div>`;
        itemHtml += `</div>`;
        
        return itemHtml;
    }

    async function fetchAgendas(year, month) {
        try {
            const response = await fetch(`/api/agendas/${year}/${month}`);
            if (!response.ok) throw new Error('Gagal memuat data agenda.');
            const newAgendas = await response.json();
            agendas[`${year}-${month-1}`] = newAgendas;
        } catch (error) {
            console.error('Fetch error:', error);
            agendas[`${year}-${month-1}`] = {};
        }
    }

    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    calendarDaysContainer.addEventListener('click', (e) => {
        const dayEl = e.target.closest('.calendar-day');
        if (dayEl && dayEl.dataset.day) {
            const day = parseInt(dayEl.dataset.day, 10);
            selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
            renderCalendar();
        }
    });

    agendaListContainer.addEventListener('click', function(e) {
        const header = e.target.closest('.agenda-item-header');
        if (header) {
            const parentItem = header.closest('.single-agenda-item');
            parentItem.classList.toggle('active');
        }
    });

    renderCalendar();
});
</script>
@endpush

