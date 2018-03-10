{/* <script type="text/javascript"> */}
    var chart = c3.generate({
        bindto: '#div-turtleometer',
        data: {
            columns: [
                ['% Plastic Straw free', strawPercentage]
            ],
            type: 'gauge',
        },
        color: {
            pattern: ['#FF0000', '#F97600', '#F6C600', '#60B044'], // the three color levels for the percentage values.
            threshold: {
                values: [30, 60, 90, 100]
            }
        },
        size: {
            height: 280
        }
    });
// </script>