<script>
    document.getElementById('startButton').addEventListener('click', function() {
        var artistName = prompt("Digite o nome do artista:");
        if (artistName) {
            fetchTopSongs(artistName);
        }
    });

    function fetchTopSongs(artist) {
        var apiKey = "9e06728c486bda235dbc686173e8b6c3";
        var url = "https://ws.audioscrobbler.com/2.0/?method=artist.gettoptracks&artist=" + encodeURIComponent(artist) + "&api_key=" + apiKey + "&format=json";

        fetch(url)
        .then(response => response.json())
        .then(data => {
            var topTracks = data.toptracks.track;
            var topSongsDiv = document.getElementById('topSongs');
            topSongsDiv.innerHTML = "<h2>As músicas mais populares de " + artist + " são:</h2>";

            topTracks.forEach(function(track) {
                var audioSampleUrl = track.url; // URL para a amostra de áudio do Last.fm
                var trackName = track.name;
                var artistName = track.artist.name;

                var audioPlayer = new Audio(audioSampleUrl);
                var audioPlayerElement = document.createElement('audio');
                audioPlayerElement.controls = true;
                audioPlayerElement.src = audioSampleUrl;

                var trackInfoElement = document.createElement('p');
                trackInfoElement.textContent = trackName + " - " + artistName + ": ";
                trackInfoElement.appendChild(audioPlayerElement);

                topSongsDiv.appendChild(trackInfoElement);
            });
        })
        .catch(error => {
            console.error('Erro ao buscar as músicas:', error);
        });
    }
</script>


