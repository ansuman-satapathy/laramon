# **LaraMon**

**A monitoring dashboard package for Laravel with Livewire & Flux UI.**

![LaraMon Banner](https://via.placeholder.com/1200x400?text=LaraMon)

## **📌 Features**

✅ **Livewire-based** real-time UI updates.  
✅ **Flux UI** for a modern and customizable UI.  
✅ **Tailwind CSS** for styling.  
✅ **Vite-powered asset bundling.  
✅ **Modular & Extendable\*\* package structure.

---

## **📦 Installation**

### **1️⃣ Install LaraMon via Composer**

```sh
composer require ansuman/laramon
```

---

## **⚙️ Requirements & Dependencies**

Before installing, make sure you have the following dependencies:

| Dependency       | Version  | Required?   | Purpose               |
| ---------------- | -------- | ----------- | --------------------- |
| **Laravel**      | `>=10.x` | ✅ Yes      | Core framework        |
| **Livewire**     | `>=3.x`  | ✅ Yes      | UI components         |
| **Flux UI**      | `^1.0`   | ✅ Yes      | UI framework          |
| **Tailwind CSS** | `^3.x`   | ✅ Yes      | Styling               |
| **Vite**         | `^5.x`   | ✅ Yes      | Asset bundling        |
| **Alpine.js**    | `^3.x`   | Recommended | Extra UI interactions |

Packages:

"livewire/livewire"
"livewire/volt"
"livewire/flux"
"rappasoft/laravel-livewire-tables"
"codeat3/blade-fontawesome"

---

## **🔧 Setup Instructions**

### **2️⃣ Publish Config & Assets**

```sh
php artisan vendor:publish --tag=laramon-config
```

### **3️⃣ Install Frontend Dependencies**

Ensure that you have `node.js` installed, then run:

```sh
npm install
```

### **4️⃣ Include LaraMon’s Flux UI CSS**

Add the following to your `resources/css/app.css` file:

```css
@import "../../vendor/livewire/flux/dist/flux.css";

@custom-variant dark (&:where(.dark, .dark *));

/* We recommend using Font: Inter */
@theme {
    --font-sans: Inter, sans-serif;
}

/* Customize accent colors if needed */

@theme {
    --color-zinc-50: var(--color-slate-50);
    --color-zinc-100: var(--color-slate-100);
    --color-zinc-200: var(--color-slate-200);
    --color-zinc-300: var(--color-slate-300);
    --color-zinc-400: var(--color-slate-400);
    --color-zinc-500: var(--color-slate-500);
    --color-zinc-600: var(--color-slate-600);
    --color-zinc-700: var(--color-slate-700);
    --color-zinc-800: var(--color-slate-800);
    --color-zinc-900: var(--color-slate-900);
    --color-zinc-950: var(--color-slate-950);
}

@theme {
    --color-accent: var(--color-lime-400);
    --color-accent-content: var(--color-lime-600);
    --color-accent-foreground: var(--color-lime-900);
}

@layer theme {
    .dark {
        --color-accent: var(--color-lime-400);
        --color-accent-content: var(--color-lime-400);
        --color-accent-foreground: var(--color-lime-950);
    }
}
```

---

### **5️⃣ Build Assets with Vite**

Run the following to compile assets:

```sh
npm run dev
```

For production builds:

```sh
npm run build
```

---

## **🛠 Commands**

### **Publish Config**

```sh
php artisan vendor:publish --tag=laramon-config
```

### **Publish Views**(Coming soon!)

```sh
php artisan vendor:publish --tag=laramon-views
```

### **Migrate Database**

```sh
php artisan migrate
```

---

## **📖 Documentation**

[➡️ Read the full documentation](#) (Coming soon!)

---

## **🚀 Contributing**

Feel free to submit pull requests or report issues. Contributions are always welcome!

---

## **📜 License**

LaraMon is **open-source** under the [MIT License](LICENSE).
