// Dashboard 1 Morris-chart

Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '1',
            Anggaran: 0,
            Realisasi: 0
        }, {
            period: '2',
            Anggaran: 100,
            Realisasi: 65
        }, {
            period: '3',
            Anggaran: 180,
            Realisasi: 120
        }, {
            period: '4',
            Anggaran: 100,
            Realisasi: 40
        }],
        xkey: 'period',
        ykeys: ['Anggaran', 'Realisasi'],
        labels: ['Anggaran', 'Realisasi'],
        pointSize: 0,
        fillOpacity: 0.99,
        pointStrokeColors:['#006DF0', '#65b12d'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth:0,
        hideHover: 'auto',
        lineColors: ['#006DF0', '#65b12d'],
        resize: true
        
    });
	
Morris.Area({
        element: 'extra-area-chart',
        data: [{
            period: '1',
            Anggaran: 50,
            Realisasi: 80
        }, {
            period: '2',
            Anggaran: 130,
            Realisasi: 100
        }, {
            period: '3',
            Anggaran: 80,
            Realisasi: 60
        }, {
            period: '4',
            Anggaran: 70,
            Realisasi: 200
        }],
        xkey: 'period',
        ykeys: ['Anggaran', 'Realisasi'],
        labels: ['Anggaran', 'Realisasi'],
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors:['#006DF0', '#65b12d'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 1,
        hideHover: 'auto',
        lineColors: ['#006DF0', '#65b12d'],
        resize: true
        
    });