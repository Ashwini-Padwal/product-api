document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('end_year').addEventListener('change', updateData);
    document.getElementById('topic').addEventListener('change', updateData);
    // Add event listeners for other filters similarly
    
    function updateData() {
        const filters = {
            end_year: document.getElementById('end_year').value,
            topic: document.getElementById('topic').value,
            // Get values of other filters similarly
        };
        
        let url = 'api.php';
        let params = new URLSearchParams(filters);
        url += '?' + params.toString();
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                updateCharts(data);
            });
    }
    
    function updateCharts(data) {
        // Use D3.js to update charts with new data
        // Example: Bar chart
        d3.select('#charts').selectAll('svg').remove();
        
        const svg = d3.select('#charts')
                      .append('svg')
                      .attr('width', 600)
                      .attr('height', 400);
        
        svg.selectAll('rect')
           .data(data)
           .enter()
           .append('rect')
           .attr('x', (d, i) => i * 30)
           .attr('y', d => 400 - d.intensity)
           .attr('width', 20)
           .attr('height', d => d.intensity)
           .attr('fill', 'blue');
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const yearSelect = document.getElementById('end_year');
    years.forEach(year => {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    });
    
    const topicSelect = document.getElementById('topic');
    topics.forEach(topic => {
        const option = document.createElement('option');
        option.value = topic;
        option.textContent = topic;
        topicSelect.appendChild(option);
    });
    
    // Populate other filters similarly
    
    // Add event listeners and update data on change
    document.getElementById('end_year').addEventListener('change', updateData);
    document.getElementById('topic').addEventListener('change', updateData);
    // Add event listeners for other filters similarly
    
    function updateData() {
        const filters = {
            end_year: document.getElementById('end_year').value,
            topic: document.getElementById('topic').value,
            // Get values of other filters similarly
        };
        
        let url = 'api.php';
        let params = new URLSearchParams(filters);
        url += '?' + params.toString();
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                updateCharts(data);
            });
    }
    
    function updateCharts(data) {
        // Use D3.js to update charts with new data
        // Example: Bar chart
        d3.select('#charts').selectAll('svg').remove();
        
        const svg = d3.select('#charts')
                      .append('svg')
                      .attr('width', 600)
                      .attr('height', 400);
        
        svg.selectAll('rect')
           .data(data)
           .enter()
           .append('rect')
           .attr('x', (d, i) => i * 30)
           .attr('y', d => 400 - d.intensity)
           .attr('width', 20)
           .attr('height', d => d.intensity)
           .attr('fill', 'blue');
    }
});
