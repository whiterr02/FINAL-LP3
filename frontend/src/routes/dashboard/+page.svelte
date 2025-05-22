<script lang="ts">
  import {
    Card,
    CardContent,
    CardFooter,
    CardHeader,
    CardTitle
  } from "$lib/components/ui/card/index.ts";
</script>

<h1 class="text-2xl font-bold mb-4">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
  <Card>
    <CardHeader>
      <CardTitle>Clients</CardTitle>
    </CardHeader>
    <CardContent>
      <p>Manage client information</p>
    </CardContent>
    <CardFooter>
      <p>View Clients</p>
    </CardFooter>
  </Card>

  <Card>
    <CardHeader>
      <CardTitle>Products</CardTitle>
    </CardHeader>
    <CardContent>
      <p>Manage product information</p>
    </CardContent>
    <CardFooter>
      <p>View Products</p>
    </CardFooter>
  </Card>

  <Card>
    <CardHeader>
      <CardTitle>Documents</CardTitle>
    </CardHeader>
    <CardContent>
      <p>Manage documents</p>
    </CardContent>
    <CardFooter>
      <p>View Documents</p>
    </CardFooter>
  </Card>
</div>
