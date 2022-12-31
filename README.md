# RPG Backend
This repository contains a RPG backend engine inspired/based on Final Fantasy XII. The project architecture is based on a DDD (_Domain Driven Design_) model.

**This game does not include a full FFXII gameplay experience, not even history mode, or original chars/items/etc names...**

---

## Installation and using
This project contains a configured Docker setup, and uses Kubernetes to manage multiple Pods to create Server versions with HTTP and Socket communication with the [game frontend](https://github.com/chsjr1996/rpg_frontend)

### Kubernetes
This repository contains a k8s directory that contains some YAML files. With these files you can create fully Game environment, the HTTP and Socket servers, with database and all needed 'things' to play.

> Under development...

---

## Features

### HTTP server
A HTTP server built with Swoole that expose some routes to control this game. Thought the HTTP you can list/add game 'objects' (like chars, current games, etc...).

### Socket server
A Socket server built with Swoole that exposa some channels to play this game. Thought [game frontend](https://github.com/chsjr1996/rpg_frontend) you can start a 'new game' and choose you party chars, and execute some game actions.

> The 'frontend' will be implement the "Game loop" events, and send game status updates, like enemy defeated, applied 'status effects', etc... These Socket channels will receive all events and persist them, or calculate damage, etc...

### Interactive console
Some PHP files that allow you to preview some game feature, like list chars, statuses, etc... and add chars with statuses. Maybe in the future new feataures can be added, like manage some game aspects (statuses effects, etc...)

### Another aspects

- 'Dockerized' environment with Swoole
- Allow to use Swoole Socket or HTTP server to comunicate with the game
    - You can use both servers, but not in the same PHP CLI process... see "Installation and using > Kubernetes" section
- Persiste Game Machine State on DB
- Process all 'RPG Math' game on server side

---

## TODO
- ⚙️ Add Socket channel
- ⚙️ Restructure project architecture (DDD)*
- ⚙️ Add Service Container (PHP DI)
- `pending` Gambits system
- `pending` Battle system (RPG 'calculator' engine)
- `pending` Add 'persistence layer' (RedBean or Doctrine ORM)
- `pending` Create a frontend application engine (gameloop/actions)
- `pending` Kubernetes environment

and more...

> * Need to be more decoupled?

---

### Under development