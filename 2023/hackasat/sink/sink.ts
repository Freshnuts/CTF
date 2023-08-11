import { Client } from "ssh2";

const conn = new Client();
const remoteHost = "basic-async-aip7aibe.eames.satellitesabove.me";
const remotePort = 443;
const remoteUsername = "ticket{echo792778tango4:GM2O0NdZcZyD3kNRuZajB57R3H2RdBwdn_6p-I2DZykI9mKMdUM48O1g6QEHpuIEBg}";
const remoteCommand = `echo $flag`;

conn.on("ready", () => {
  conn.exec(remoteCommand, (err, stream) => {
    if (err) {
      console.error(`Error executing remote command: ${err.message}`);
      conn.end();
      return;
    }

    stream.on("close", (code, signal) => {
      if (code !== 0) {
        console.error(`Remote command failed with code ${code} and signal ${signal}`);
        conn.end();
        return;
      }

      const flag = stream.stdout.toString().trim();

      // Print the value of the "flag" environment variable to the console
      console.log(`The value of the 'flag' environment variable is: ${flag}`);

      conn.end();
    });
  });
}).connect({
  host: remoteHost,
  port: remotePort,
  username: remoteUsername,
});

