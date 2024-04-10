const WebSocket = require('ws');

const wss = new WebSocket.Server({ port: 8080 });

wss.on('connection', function connection(ws) {
   console.log('Client verbunden');

  ws.on('message', function incoming(message) {
    console.log('Erhaltene Nachricht: %s', message);
    // Hier könnten Sie die Nachricht verarbeiten und eine Antwort generieren
    const data = JSON.parse(message);

    // Beispielantwort, die an den Client gesendet wird
    if(data.text) {
      const response = { status: true, data: { response: "Verarbeitete Antwort: " + data.text } };
      ws.send(JSON.stringify(response));
    } else {
      ws.send(JSON.stringify({ status: false, error: "Kein Text empfangen" }));
    }
  });

  // Senden Sie eine Nachricht an den Client, sobald die Verbindung hergestellt ist
  ws.send(JSON.stringify({ status: true, data: { response: "Verbindung erfolgreich hergestellt" } }));
});
