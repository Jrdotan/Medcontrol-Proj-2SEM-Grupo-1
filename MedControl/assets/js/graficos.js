class MapaGeoChart {
    constructor(divId) {
        if (typeof divId !== 'string') {
            throw new Error('O ID do elemento deve ser uma string.');
        }
        this.divId = divId;
        this.tokenApi = 'AIzaSyAN_eSMlZ1bgYk4_yZCY3dVRawj1vL1UHk'
    }

    carregarMapa() {
        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': this.tokenApi
        });

        google.charts.setOnLoadCallback(() => {
            this.desenharMapa();
        });
    }

    desenharMapa() {
        if (!document.getElementById(this.divId)) {
            throw new Error(`Elemento com ID '${this.divId}' não encontrado.`);
        }

        var data = google.visualization.arrayToDataTable([
            ['City', 'Contaminados', { role: 'tooltip', 'p': { 'html': true } }],
            ['São Paulo', 5, 'Doença: COVID-19<br>Contaminados: 500'],
            ['Leme', 1, 'Doença: Dengue<br>Contaminados: 100'],
            ['Araras', 3, 'Doença: Cancer<br>Contaminados: 300'],
            ['Rio Claro', 2, 'Doença: Morte<br>Contaminados: 250'],
            // Adicione mais cidades conforme necessário
        ]);

        var options = {
            region: 'BR',
            displayMode: 'markers',
            resolution: 'provinces',
            tooltip: { isHtml: true },
            colorAxis: { colors: ['yellow', 'red'] },
        };

        var chart = new google.visualization.GeoChart(document.getElementById(this.divId));
        chart.draw(data, options);

        window.addEventListener('resize', () => {
            chart.draw(data, options);
        });
    }
}


class GraficoXChart {
    constructor(divId) {
        if (typeof divId !== 'string') {
            throw new Error('O ID do elemento deve ser uma string.');
        }
        this.divId = divId;
    }

    carregarGraficoX() {
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(() => {
            this.renderGrafico();
        });
    }

    renderGrafico() {
        if (!document.getElementById(this.divId)) {
            throw new Error(`Elemento com ID '${this.divId}' não encontrado.`);
        }

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Semana');
        data.addColumn('number', 'Dados <Ano 01>');
        data.addColumn('number', 'Dados <Ano 02>');
        data.addRows([
            ['46', 156, null],
            ['47', 148, null],
            ['48', 524, null],
            ['49', 533, null],
            ['50', 101, null],
            ['51', 75, null],
            ['52', 35, null],
            ['01', null, 20],
            ['02', null, 500],
            ['03', null, 50]
        ]);

        const options = {
            legend: { position: 'top' },
            height: 300,
            colors: ['#9575cd', '#30b27f'],
            hAxis: {
                title: 'Semana Epidemiológica',
                titleTextStyle: {
                    fontSize: 13,
                    bold: true,
                    italic: false
                }
            },
            vAxis: {
                title: 'Casos Novos',
                titleTextStyle: {
                    fontSize: 13,
                    bold: true,
                    italic: false
                },
            },
            isStacked: true
        };
        const chart = new google.visualization.ColumnChart(document.getElementById(this.divId));
        chart.draw(data, options);

        window.addEventListener('resize', () => {
            chart.draw(data, options);
        });
    }
}

class GraficoLinhaChart {
    constructor(divId) {
        this.divId = divId;
    }

    carregarLinhas() {
        google.charts.load('current', { 'packages': ['line'] });
        google.charts.setOnLoadCallback(() => {
            this.drawChart();
        });
    }

    drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Day');
        data.addColumn('number', 'Guardians of the Galaxy');
        data.addColumn('number', 'The Avengers');
        data.addColumn('number', 'Transformers: Age of Extinction');

        data.addRows([
            [1, 37.8, 80.8, 41.8],
            [2, 30.9, 69.5, 32.4],
            [3, 25.4, 57, 25.7],
            [4, 11.7, 18.8, 10.5],
            [5, 11.9, 17.6, 10.4],
            [6, 8.8, 13.6, 7.7],
            [7, 7.6, 12.3, 9.6],
            [8, 12.3, 29.2, 10.6],
            [9, 16.9, 42.9, 14.8],
            [10, 12.8, 30.9, 11.6],
            [11, 5.3, 7.9, 4.7],
            [12, 6.6, 8.4, 5.2],
            [13, 4.8, 6.3, 3.6],
            [14, 4.2, 6.2, 3.4]
        ]);

        const options = {
            legend: { position: 'top' },
            chart: {
                title: 'Box Office Earnings in First Two Weeks of Opening',
                subtitle: 'in millions of dollars (USD)'
            },
        };

        const chart = new google.charts.Line(document.getElementById(this.divId));
        chart.draw(data, options);

        window.addEventListener('resize', () => {
            chart.draw(data, options);
        });
    }
}