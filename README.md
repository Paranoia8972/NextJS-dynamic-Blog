## Getting Started

First, you need to create a new Collection in PocketBase:

| Name | Type | Nonempty / Type |
|----------|----------|----------|
| name | Plain text | true |
| slug | Plain text | true |
| published | bool | false |
| description | string | true |
| image | file | single |
| body | Rich editor | true |
| likes | number | false |

Second, configure the URL for PocketBase in [pb.config.js](https://github.com/Paranoia8972/Blog-Source-Code/blob/main/pb.config.js)

Third, run the development server:

```bash
npm run dev
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

