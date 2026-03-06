<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kunst in C</title>

    <style>
      @import url("https://fonts.cdnfonts.com/css/new-york-extra-large");

      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      body {
        background: rgb(255, 255, 255);
        background-repeat: no-repeat;
        font-family: "New York Extra Large", sans-serif;
        margin: 0;
        padding: 0;
        width: 100dvw;
        height: 100vh;
        overflow: hidden;

        & main {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100dvh;
          & .centered {
            width: 500px;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 30px;
            margin: 0 auto;
            border-radius: 10px;
            text-align: center;

            & img {
              margin-bottom: 50px;
              width: 300px;
            }

            & h1 {
              font-size: 3em;
              margin: 0px 0 30px 0px;
              color: #e30613;
              font-style: italic;
            }

            & section.pre-footer {
              position: absolute;
              bottom: 20px;
            }

            & p {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }

            & a {
                color: black;
                font-weight: 600;
            }
          }
        }
      }

        @media (max-width: 500px) {
            body {
            & main {
                & .centered {
                width: 100%;
                padding: 10px;
                & img {
                    width: 200px;
                }
                & h1 {
                    font-size: 2em;
                }
                }
            }
            }
        }
    </style>
  </head>
  <body>
    <main>
      <section class="centered">
        <img
          src="https://kunstinc.nl/wp-content/uploads/2024/05/logo.png"
          alt="logo of kunst in c"
        />
        <p>Je zult nog even moeten wachten!</p>
        <h1>Binnenkort te zien</h1>

        <section class="pre-footer">
          <p>
            Heeft u vragen of opmerkingen?
            <br />
            <a href="mailto:info@kunstinc.nl">info@kunstinc.nl</a>
          </p>
        </section>
      </section>
    </main>
  </body>
</html>
