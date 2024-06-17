class MapaGeoChart {
    constructor(divId, jsonDataMapaChart=0, colores = ['yellow', 'red']) {
        if (typeof divId !== 'string') {
            throw new Error('O ID do elemento deve ser uma string.');
        }
        this.divId = divId;
        this.tokenApi = 'AIzaSyAN_eSMlZ1bgYk4_yZCY3dVRawj1vL1UHk';
        this.colores = colores;
        this.jsonDataMapaChart = jsonDataMapaChart;
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

        var dataArray = [
            ['City', 'Contaminados', { role: 'tooltip', 'p': { 'html': true } }]
        ];
        
        for (var i = 0; i < this.jsonDataMapaChart.length; i++) {
            var tooltip = 'Doença: ' + this.jsonDataMapaChart[i].doenca + '<br>' + this.jsonDataMapaChart[i].Infoadicional;
            dataArray.push([this.jsonDataMapaChart[i].cidade, parseInt(this.jsonDataMapaChart[i].contaminados), tooltip]);
        }

        var data = google.visualization.arrayToDataTable(dataArray);

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
    constructor(divId, jsonDataXChart=0, anoAtual, AnoPassado, colores = ['yellow', 'red']) {
        if (typeof divId !== 'string') {
            throw new Error('O ID do elemento deve ser uma string.');
        }
        this.divId = divId;
        this.colores = colores
        this.anoAtual = anoAtual;
        this.AnoPassado = AnoPassado
        this.jsonDataXChart = jsonDataXChart
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
        data.addColumn('number', this.AnoPassado);
        data.addColumn('number', this.anoAtual);

        // Loop para o ano passado
        for (var i = 0; i < this.jsonDataXChart['anoPassado'].length; i++) {
            var semana = this.jsonDataXChart['anoPassado'][i].Semana.toString();
            var casosAnoPassado = parseInt(this.jsonDataXChart['anoPassado'][i].Casos);

            // Note que casosAnoAtual será null para o ano passado
            var casosAnoAtual = null;

            data.addRows([[semana, casosAnoPassado, casosAnoAtual]]);
        }

        // Loop para o ano atual
        for (var i = 0; i < this.jsonDataXChart['anoAtual'].length; i++) {
            var semana = this.jsonDataXChart['anoAtual'][i].Semana.toString();
            var casosAnoAtual = parseInt(this.jsonDataXChart['anoAtual'][i].Casos);

            // Note que casosAnoPassado será null para o ano atual
            var casosAnoPassado = null;

            data.addRows([[semana, casosAnoPassado, casosAnoAtual]]);
        }


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
    constructor(divId, jsonDataLinhaChart=0) {
        this.divId = divId;
        this.jsonDataLinhaChart = jsonDataLinhaChart;
    }

    carregarLinhas() {
        google.charts.load('current', { 'packages': ['line'] });
        google.charts.setOnLoadCallback(() => {
            this.drawChart();
        });
    }

    drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Semana');

        this.jsonDataLinhaChart.columns.forEach(column => {
            data.addColumn('number', column);
        });

        // Adiciona as linhas dinamicamente
        data.addRows(this.jsonDataLinhaChart.rows.map(row => {
            return row.map((item, index) => {
                return index === 0 ? item.toString() : parseInt(item, 10);
            });
        }));

        const options = {
            legend: { position: 'top' },
            vAxis: {
                minValue: 1
            }
        };

        const chart = new google.charts.Line(document.getElementById(this.divId));
        chart.draw(data, options);

        window.addEventListener('resize', () => {
            chart.draw(data, options);
        });
    }
}