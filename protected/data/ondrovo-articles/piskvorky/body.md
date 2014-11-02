$ This is a multiplayer online game of five-in-a-row, also known as Gomoku or in Czech Piškvorky.

It's an old project, but still works. If you have someone to play with, you can try it out.

Visit **[ondrovo.com/piskvorky](piskvorky)** and start a new game. You can also switch language to English or some of the others, if you want.

You will be told a game ID. Your opponent then enters this game ID, and you can play together.

On the left, there's also some kind of chat.

## How it works

The application uses MySQL database to store data about the games, and the chat messages. Those are deleted after some time, of course.

The communication is done via AJAX calls to a server-side PHP script. A request is sent each time you write something, click a button or place a mark, and also every few seconds to check for updates.

*If you have an idea for improvement, or want to share some experience from the game, feel free to comment below.*
