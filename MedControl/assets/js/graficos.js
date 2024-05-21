class MapaGeoChart {
    constructor(divId, info, colores = ['yellow', 'red']) {
        if (typeof divId !== 'string') {
            throw new Error('O ID do elemento deve ser uma string.');
        }
        this.divId = divId;
        this.tokenApi = 'AIzaSyAN_eSMlZ1bgYk4_yZCY3dVRawj1vL1UHk'
        this.colores = colores,
        this.info = info
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
            ['Leme', 1, `Doença: Dengue<br>${this.info}: 100`],
            ['Araras', 3, 'Doença: Cancer<br>Contaminados: 300'],
            ['Rio Claro', 2, 'Doença: Morte<br>Contaminados: 250'],
            // Adicione mais cidades conforme necessário
        ]);

        var options = {
            region: 'BR',
            displayMode: 'markers',
            resolution: 'provinces',
            tooltip: { isHtml: true },
            colorAxis: { colors: this.colores },
        };

        var chart = new google.visualization.GeoChart(document.getElementById(this.divId));
        chart.draw(data, options);

        window.addEventListener('resize', () => {
            chart.draw(data, options);
        });
    }
}


class GraficoXChart {
    constructor(divId, colores = ['yellow', 'red']) {
        if (typeof divId !== 'string') {
            throw new Error('O ID do elemento deve ser uma string.');
        }
        this.divId = divId;
        this.colores = colores
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
            colors: this.colores,
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
        data.addColumn('string', 'Day');
        data.addColumn('number', 'Leme');
        data.addColumn('number', 'Araras');
        data.addColumn('number', 'Rio Claro');

        data.addRows([
            ['1', 20, 50, 30],
            ['2', 10, 50, 50],
            ['3', 15, 60, 30],
            ['4', 15, 14, 35],
            ['5', 15, 14, 35],
            ['6', 15, 14, 35]
        ]);

        const options = {
            legend: { position: 'top' },
        };

        const chart = new google.charts.Line(document.getElementById(this.divId));
        chart.draw(data, options);

        window.addEventListener('resize', () => {
            chart.draw(data, options);
        });
    }
}